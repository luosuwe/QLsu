package com.tencent.qqnt.kernelgpro.nativeinterface;

public class GProGuild {

    public long guildId;
    public String guildName = "";
    public GProGuildInfo guildInfo = new GProGuildInfo();

    public static class GProGuildInfo {
        public String guildName = "";
        public String guildAvatar = "";
    }
}