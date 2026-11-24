package com.tencent.mobileqq.mp;

import com.tencent.mobileqq.pb.MessageMicro;
import com.tencent.mobileqq.pb.PBInt32Field;
import com.tencent.mobileqq.pb.PBInt64Field;
import com.tencent.mobileqq.pb.PBStringField;

/**
 * QQ 公众号（CertifiedAccount）协议的编译期桩。
 * 运行时真正使用的是宿主里的同名类。
 */
public class mobileqq_mp {

    public static class SendMenuEventRequest extends MessageMicro<SendMenuEventRequest> {
        public PBInt32Field uin = new PBInt32Field(0, false);
        public PBInt32Field type = new PBInt32Field(0, false);
        public PBStringField key = new PBStringField("", false);
        public PBInt64Field msg_id = new PBInt64Field(0L, false);
        public PBInt32Field s_type = new PBInt32Field(0, false);
        public PBStringField versionInfo = new PBStringField("", false);
        public PBInt32Field menu_type = new PBInt32Field(0, false);
    }
}
