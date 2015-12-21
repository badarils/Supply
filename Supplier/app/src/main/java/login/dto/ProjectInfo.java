package login.dto;

import lombok.Getter;
import lombok.Setter;

/**
 * Created by Arbind on 12/21/2015.
 */
@Getter
@Setter
public class ProjectInfo {
    private String imageURL;
    private String name;
    private String startDate;
    private String endDate;
    private String description;
    private String city;
    private String location;
    private long value;
    private String valueCurrency;
    private String materialAndLaborInfo;
    private CustomerReviews[] customerReviewses;
    private String verificationStatus;
    private CustomerDetails[] customerDetailses;
}
