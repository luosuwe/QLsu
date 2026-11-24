#!/system/bin/sh

TARGET_PKGS="com.tencent.mobileqq com.tencent.tim"

for pkg in $TARGET_PKGS; do
    rm -rf /data/data/$pkg/qlsu
    rm -rf /data/user/*/$pkg/qlsu
done

rm -f /data/local/tmp/*qlsu*