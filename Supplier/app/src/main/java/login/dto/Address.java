package login.dto;

import lombok.Getter;
import lombok.Setter;

/**
 * Created by Arbind on 12/21/2015.
 */
@Getter
@Setter
public class Address {
    private String type;
    private String address1;
    private String address2;
    private String address3;
    private String city;
    private String state;
    private String country;
    private String pincode;
}
