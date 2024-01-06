package org.spotiplay.ws;

import com.sun.net.httpserver.HttpExchange;
import org.spotiplay.model.Logging;
import org.spotiplay.repo.LoggingRepository;
import org.spotiplay.utils.ConfigLoader;

import javax.annotation.Resource;
import javax.xml.ws.WebServiceContext;
import javax.xml.ws.handler.MessageContext;
import java.net.InetSocketAddress;
import java.sql.Timestamp;
import java.util.List;
import java.util.Map;
import java.util.Properties;

public abstract class WebService {
    @Resource
    WebServiceContext wsContext;

    protected void recordClientRequest(Object ...params) throws Exception {
        MessageContext messageContext = wsContext.getMessageContext();

        // Validate Api Key
        Map<String, Object> requestHeader = (Map<String, Object>) messageContext.get(messageContext.HTTP_REQUEST_HEADERS);
        String apiKey = ((List<String>) requestHeader.get("api-key")).get(0);
        String clientName;

        System.out.println("API Key: " + apiKey);

        ConfigLoader configLoader = new ConfigLoader();
        Properties properties = configLoader.loadConfig();
        if (apiKey == null) {
            throw new Exception("Missing API Key");
        } else if (properties.getProperty("php.api_key").equals(apiKey)) {
            clientName = "PHP Spotiplay App";
        } else if (properties.getProperty("rest.api_key").equals(apiKey)) {
            clientName = "Rest Client";
        } else {
            throw new Exception("Invalid API Key");
        }

        // Get the remote IP address

        HttpExchange exchange = (HttpExchange) messageContext.get("com.sun.xml.ws.http.exchange");
        InetSocketAddress remoteAddress = exchange.getRemoteAddress();
        String remoteIP = remoteAddress.getAddress().getHostAddress();
//        String remoteIP = "http://localhost:8080";

        // Get used method name
        StackTraceElement stackTraceElement = Thread.currentThread().getStackTrace()[2];
        String endpoint = stackTraceElement.getClassName() + "." + stackTraceElement.getMethodName();

        // Get the description of the method
        StringBuilder paramsString = new StringBuilder();
        for (Object param : params) {
            if (!param.equals(params[0])) {
                paramsString.append(", ");
            }
            paramsString.append(param.toString());
        }
        String description = clientName + "(" + paramsString.toString() + ")";

        // Log the request to the database
        Timestamp timestamp = new Timestamp(System.currentTimeMillis());
        String timeString = timestamp.toString().split("\\.")[0];

        Logging logging = new Logging(description, remoteIP, endpoint, timeString);
        LoggingRepository.getInstance().create(logging);
    }

}
