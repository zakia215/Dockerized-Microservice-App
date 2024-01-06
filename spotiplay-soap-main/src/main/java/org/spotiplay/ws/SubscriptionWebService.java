package org.spotiplay.ws;

import org.spotiplay.model.Subscription;
import org.spotiplay.model.SubscriptionStatus;
import org.spotiplay.repo.SubscriptionRepository;
import org.spotiplay.utils.ConfigLoader;
import org.spotiplay.utils.HttpWrapper;

import javax.jws.WebMethod;
import javax.jws.WebService;
import java.util.*;

@WebService(endpointInterface = "org.spotiplay.ws.SubscriptionInterface")
public class SubscriptionWebService extends org.spotiplay.ws.WebService implements SubscriptionInterface {

    @Override
    @WebMethod
    public Subscription subscribe(int creator_id, int subscriber_id, String username) {
        try {
            this.recordClientRequest(creator_id, subscriber_id, username);
            Subscription subscription = new Subscription(creator_id, subscriber_id, username, null);

            Subscription insertResult = SubscriptionRepository.getInstance().create(subscription);

            Map<String, String> requestBody = new HashMap<>();
            requestBody.put("creator_id", String.valueOf(creator_id));
            requestBody.put("user_id", String.valueOf(subscriber_id));

            HttpWrapper httpWrapper = new HttpWrapper(new ConfigLoader().loadConfig().getProperty("php.subscription_url"));
            String result = httpWrapper.post(requestBody);

            System.out.println(result);
            return insertResult;

        } catch (Exception e) {
            System.out.println("exception: " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }

    @Override
    @WebMethod
    public Subscription acceptSubscription(int creator_id, int subscriber_id) {
        try {
            this.recordClientRequest(creator_id, subscriber_id);
            Subscription subscription = new Subscription(creator_id, subscriber_id, SubscriptionStatus.ACCEPTED);

            List<String> pathParams = new ArrayList<>();
            pathParams.add(String.valueOf(creator_id));
            pathParams.add(String.valueOf(subscriber_id));
            Map<String, String> queryParams = new HashMap<>();
            queryParams.put("status", SubscriptionStatus.ACCEPTED.toString().toLowerCase());

            Properties properties = new ConfigLoader().loadConfig();
            String baseUrl = properties.getProperty("php.subscription_url");
            HttpWrapper httpWrapper = new HttpWrapper(baseUrl);

            String result = httpWrapper.put(pathParams, queryParams);

            System.out.println(result);

            return SubscriptionRepository.getInstance().update(subscription);
        } catch (Exception e) {
            System.out.println("exception: " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }

    @Override
    @WebMethod
    public Subscription rejectSubscription(int creator_id, int subscriber_id) {
        try {
            this.recordClientRequest(creator_id, subscriber_id);
            Subscription subscription = new Subscription(creator_id, subscriber_id, SubscriptionStatus.REJECTED);

            List<String> pathParams = new ArrayList<>();
            pathParams.add(String.valueOf(creator_id));
            pathParams.add(String.valueOf(subscriber_id));
            Map<String, String> queryParams = new HashMap<>();
            queryParams.put("status", SubscriptionStatus.REJECTED.toString().toLowerCase());

            Properties properties = new ConfigLoader().loadConfig();
            String baseUrl = properties.getProperty("php.subscription_url");
            HttpWrapper httpWrapper = new HttpWrapper(baseUrl);

            String result = httpWrapper.put(pathParams, queryParams);

            System.out.println(result);

            return SubscriptionRepository.getInstance().update(subscription);
        } catch (Exception e) {
            System.out.println("exception: " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }

    @Override
    @WebMethod
    public List<Subscription> getSubscriptions() {
        try {
            this.recordClientRequest();
            return SubscriptionRepository.getInstance().findAll();
        } catch (Exception e) {
            System.out.println("exception: " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }

    @Override
    @WebMethod
    public List<Subscription> getSubscriptionsByCreatorId(int creator_id) {
        try {
            this.recordClientRequest(creator_id);
            return SubscriptionRepository.getInstance().findBy("creator_id", String.valueOf(creator_id));
        } catch (Exception e) {
            System.out.println("exception: " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }

    @Override
    @WebMethod
    public List<Subscription> getSubscriptionsBySubscriberId(int subscriber_id) {
        try {
            this.recordClientRequest(subscriber_id);
            return SubscriptionRepository.getInstance().findBy("user_id", String.valueOf(subscriber_id));
        } catch (Exception e) {
            System.out.println("exception: " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }

    @Override
    @WebMethod
    public List<Subscription> getSubscriptionsByStatus(String status) {
        try {
            this.recordClientRequest(status);
            return SubscriptionRepository.getInstance().findBy("STATUS", status);
        } catch (Exception e) {
            System.out.println("exception: " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }

    @Override
    @WebMethod
    public List<Subscription> checkSubscriptionStatus(int creator_id, int subscriber_id) {
        return null;
    }
}
