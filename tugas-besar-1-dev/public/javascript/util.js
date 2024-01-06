class Util {
    async ajax(url, payload, xml, method) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            xhr.onload = () => {
                if (!xml) {
                    try {
                        resolve(xhr.responseText);
                    } catch (e) {
                        reject(e);
                    }
                } else {
                    try {
                        resolve(xhr.responseXML);
                    } catch (e) {
                        reject(e);
                    }
                }
            };

            xhr.onerror = () => {
                reject(new Error(xhr.statusText));
            };

            const usedMethod = method || "GET";
            const params = new URLSearchParams(payload).toString();
            xhr.open(
                usedMethod,
                usedMethod !== "GET" ? url : payload ? `${url}?${params}` : url
            );
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            payload ? xhr.send(params) : xhr.send();
        });
    }

    async get(url, payload, asXML) {
        return await this.ajax(url, payload, asXML, "GET");
    }

    async post(url, payload, asXML) {
        return await this.ajax(url, payload, asXML, "POST");
    }

    async put(url, payload, asXML) {
        return await this.ajax(url, payload, asXML, "PUT");
    }

    async delete(url, asXML) {
        return await this.ajax(url, null, asXML, "DELETE");
    }
    async fetchJSON(url, payload = {}){
        const response = await this.get(url, payload);
        try {
            return JSON.parse(response);
        } catch (error) {
            throw new Error("Failed to parse JSON response");
        }
    }

    async uploadFile(file, url, asXML = false) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            const formData = new FormData();
            formData.append('file', file);

            xhr.onload = () => {
            if (!asXML) {
                    try {
                        resolve(xhr.responseText);
                    } catch (e) {
                        reject(e);
                    }
                } else {
                    resolve(xhr.responseXML);
                }
            };

            xhr.onerror = () => {
                reject(new Error("Fetch error"));
            };
            
            xhr.open("POST", url, true);
            xhr.send(formData);
        });
    }

    debounce(func, timeout=200, parameter) {
        let timer = null;

        // Returns a function with potentially some arguments
        return function(...args) {
            clearTimeout(timer);
            timer = setTimeout(() => { 
                func.apply(this, args); 
            }, timeout);
        };
    }

}
