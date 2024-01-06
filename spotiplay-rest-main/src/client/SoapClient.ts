import axios from 'axios';
import * as xmlbuilder from 'xmlbuilder';
import converter from 'xml-js';

class SoapClient {
    private url: string;

    constructor(url: string) {
        this.url = url;
    }

    public async call(method: string, params: any) {
        const xml = xmlbuilder.create({
            Envelope: {
                '@xmlns': 'http://schemas.xmlsoap.org/soap/envelope/',
                Body: {
                    [method]: {
                        '@xmlns': 'http://ws.spotiplay.org/',
                        ...this.buildParams(params)
                    }
                }
            }
        }).end({ pretty: true });

        try {
            const response = await axios.post(this.url, xml, {
                headers: {
                    'Content-Type': 'text/xml',
                    'SOAPAction': '"http://ws.spotiplay.org/' + method + '"',
                    'api-key': process.env.SOAP_API_KEY
                }
            });
            const data = response.data;
            const json = JSON.parse(converter.xml2json(data, { compact: true, spaces: 4 }));
    
            const result = json['S:Envelope']['S:Body']['ns2:' + method + 'Response']['return'];
    
            if (!result) {
                return null;
            }
    
            if (Array.isArray(result)) {
                return result.map((item: any) => {
                    return this.flatten(item);
                });
            }
    
            return this.flatten(result);
        } catch (error) {
            throw error;
        }

    }

    private flatten(json: JSON): JSON {
        const result: any = {};

        Object.keys(json).forEach((key) => {
            const value = json[key as keyof typeof json];
            result[key] = value['_text' as keyof typeof value];
        });

        return result;
    }

    private buildParams(params: any): any {
        const result: any = {};

        let count = 0;
        for (const key in params) {
            if (params.hasOwnProperty(key)) {
                const value = params[key];
                result['arg' + count] = {
                    '@xmlns': '',
                    '#text': value
                };
            }
            count++;
        }
        return result;
    }
};

const soapUrl = process.env.SOAP_URL || "http://host.docker.internal:3001/Subscribe";
export default new SoapClient(soapUrl);
