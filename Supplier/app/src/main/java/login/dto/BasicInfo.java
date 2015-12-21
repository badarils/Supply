package login.dto;

import lombok.Getter;
import lombok.Setter;

/**
 * Created by akshay on 18/12/15.
 */
@Getter
@Setter
public class BasicInfo {

   private String photoURL;
   private String proprietorFirstName;
   private String proprietorLastName;
   private String company;
   private String typeOfFirm;
   private String establishment;
   private String manPower;
   private ContactPerson contactPerson;
   private CustomerDetails[] customerDetails;
   private String[] website;
   private  String[] email;
   private String[] telephone;
   private String[] mobile;
   private Expertise[] expertise;
   private Address[] address;

}
