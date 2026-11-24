package com.tencent.mobileqq.vashealth.websso;

import com.tencent.mobileqq.pb.MessageMicro;
import com.tencent.mobileqq.pb.PBField;
import com.tencent.mobileqq.pb.PBStringField;

public class WebSSOAgent {

    public static class UniSsoServerReq extends MessageMicro<UniSsoServerReq> {
        public PBStringField reqdata = PBField.initString("");
    }

    public static class UniSsoServerRsp extends MessageMicro<UniSsoServerRsp> {
        public PBStringField ret = PBField.initString("");
    }
}