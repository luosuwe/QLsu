package mqq.app;

import com.tencent.qphone.base.remote.ToServiceMsg;

import java.util.HashMap;

public class Packet {

    public HashMap<String, Object> attributes;

    public Packet(String uin) {
        throw new RuntimeException("Stub!");
    }

    public void setSSOCommand(String cmd) {
        throw new RuntimeException("Stub!");
    }

    public void putSendData(byte[] data) {
        throw new RuntimeException("Stub!");
    }

    public void setTimeout(long timeout) {
        throw new RuntimeException("Stub!");
    }

    public void setNoResponse() {
        throw new RuntimeException("Stub!");
    }

    public ToServiceMsg toMsg() {
        throw new RuntimeException("Stub!");
    }
}