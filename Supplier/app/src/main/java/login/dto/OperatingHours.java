package login.dto;

import lombok.Getter;
import lombok.Setter;

/**
 * Created by Arbind on 12/21/2015.
 */
@Getter
@Setter
public class OperatingHours {
    private String day;
    private String start;
    private String close;
    private String remarks;
}
