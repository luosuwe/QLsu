package mqq.app;

import android.content.Intent;

import com.tencent.qphone.base.remote.FromServiceMsg;

public abstract class MSFServlet extends Servlet {

    public abstract void onReceive(Intent intent, FromServiceMsg fromServiceMsg);

    public abstract void onSend(Intent intent, Packet packet);
}