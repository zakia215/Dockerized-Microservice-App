package org.spotiplay.ws;

import org.spotiplay.model.Subscription;

import javax.jws.WebMethod;
import javax.jws.WebService;
import java.util.List;

@WebService
public interface SubscriptionInterface {
    @WebMethod
    public Subscription subscribe(int creator_id, int subscriber_id, String username);

    @WebMethod
    public Subscription acceptSubscription(int creator_id, int subscriber_id);

    @WebMethod
    public Subscription rejectSubscription(int creator_id, int subscriber_id);

    @WebMethod
    public List<Subscription> getSubscriptions();

    @WebMethod
    public List<Subscription> getSubscriptionsByCreatorId(int creator_id);

    @WebMethod
    public List<Subscription> getSubscriptionsBySubscriberId(int subscriber_id);

    @WebMethod
    public List<Subscription> getSubscriptionsByStatus(String status);

    @WebMethod
    public List<Subscription> checkSubscriptionStatus(int creator_id, int subscriber_id);
}
