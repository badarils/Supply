package cache;

import java.io.IOException;

/**
 * Created by Arbind on 12/19/2015.
 */
public interface Cache {
    public String getValue(String key) throws IOException;
    public boolean contains(String key) throws IOException;
    public void setKeyValue(String key, String value) throws IOException;
    public void clearCache() throws IOException;
}
