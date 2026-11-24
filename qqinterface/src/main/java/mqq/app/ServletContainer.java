package mqq.app;

import java.util.concurrent.ConcurrentHashMap;

public class ServletContainer {

    public ConcurrentHashMap<String, Servlet> managedServlet = new ConcurrentHashMap<>();
}