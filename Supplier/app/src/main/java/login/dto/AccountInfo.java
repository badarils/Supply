package login.dto;

import lombok.Getter;
import lombok.Setter;

/**
 * Created by akshay on 18/12/15.
 */
@Getter
@Setter
public class AccountInfo {



    private int customerId;
    public int serviceProdiverId;
    public String firstName;
    public String lastName;
    public String mobile;
    public String email;
    public String serviceTaxNumber;
    public String PAN;
    public String TAN;
    public String AadharNumber;
    public String startDate;
    public String endDate;
    public String isActive;
    public String verificationStatus;
    public String paymentStatus;

    public ContactPerson contactPerson;






}
