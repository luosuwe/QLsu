package com.tencent.qqnt.kernelgpro.nativeinterface;

import java.util.ArrayList;

public interface IGProGetGuildsInContactCallback {
    void onResult(ArrayList<GProGuild> created, ArrayList<GProGuild> managed, ArrayList<GProGuild> joined);
}