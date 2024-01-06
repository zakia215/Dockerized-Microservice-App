package org.spotiplay.model;

import javax.xml.bind.annotation.XmlEnum;

@XmlEnum
public enum SubscriptionStatus {
    PENDING,
    ACCEPTED,
    REJECTED;

    public static SubscriptionStatus fromString(String value) {
        for (SubscriptionStatus status : SubscriptionStatus.values()) {
            if (status.toString().equalsIgnoreCase(value)) {
                return status;
            }
        }
        return null;
    }


}
