package com.tencent.qphone.base.remote;

import android.os.Parcel;
import android.os.Parcelable;

import androidx.annotation.NonNull;

public class FromServiceMsg implements Parcelable, Cloneable {

    private String serviceCmd;
    private byte[] wupBuffer;
    public java.util.HashMap<String, Object> attributes = new java.util.HashMap<>();
    public android.os.Bundle extraData = new android.os.Bundle();
    public int resultCode;

    public boolean isSuccess() {
        return this.resultCode == 1000;
    }

    public Object getAttribute(String key) {
        return this.attributes == null ? null : this.attributes.get(key);
    }

    public byte[] getWupBuffer() {
        return wupBuffer;
    }

    public void setWupBuffer(byte[] wupBuffer) {

    }

    public String getServiceCmd() {
        return serviceCmd;
    }

    public void setServiceCmd(String serviceCmd) {

    }

    public FromServiceMsg(Parcel parcel) {
    }

    public static final Creator<FromServiceMsg> CREATOR = new Creator<>() {
        @Override
        public FromServiceMsg createFromParcel(Parcel in) {
            return new FromServiceMsg(in);
        }

        @Override
        public FromServiceMsg[] newArray(int size) {
            return new FromServiceMsg[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(@NonNull Parcel dest, int flags) {
    }

    @NonNull
    @Override
    public FromServiceMsg clone() {
        try {
            return (FromServiceMsg) super.clone();
        } catch (CloneNotSupportedException e) {
            throw new AssertionError();
        }
    }
}
