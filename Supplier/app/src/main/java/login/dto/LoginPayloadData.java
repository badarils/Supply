package login.dto;

import lombok.Getter;
import lombok.Setter;

/**
 * Created by Arbind on 12/21/2015.
 */
@Getter
@Setter
public class LoginPayloadData {

    public String getMobile() {
        return mobile;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    private String mobile;
    private String password;
}
