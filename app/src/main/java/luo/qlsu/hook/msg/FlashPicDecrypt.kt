package luo.qlsu.hook.msg

import android.graphics.Color
import android.view.Gravity
import android.view.View
import android.widget.FrameLayout
import android.widget.TextView
import com.tencent.qqnt.kernel.nativeinterface.MsgRecord
import luo.qlsu.annotation.HookCategory
import luo.qlsu.annotation.HookItemAnnotation
import luo.qlsu.hook.api.AIOViewUpdateListener
import luo.qlsu.hook.api.GetMsgRecordListener
import luo.qlsu.hook.base.BaseSwitchHookItem

@HookItemAnnotation(
    "闪照破解",
    "以图片方式直接显示闪照",
    HookCategory.MSG
)
object FlashPicDecrypt : BaseSwitchHookItem(), GetMsgRecordListener, AIOViewUpdateListener {

    private const val MARKER = "闪照"

    override fun onGet(msgRecord: MsgRecord) {
        if (!isEnable) return
        val subMsgType = msgRecord.subMsgType
        if (subMsgType == 8194) {
            msgRecord.subMsgType = subMsgType and 8192.inv()
            msgRecord.guildName = MARKER
        }
    }

    override fun onUpdate(frameLayout: FrameLayout, msgRecord: MsgRecord) {

        if (msgRecord.msgType != 2) return

        val isFlash = MARKER == msgRecord.guildName

        val tagView = frameLayout.findViewWithTag<TextView>("FlashMarker")

        if (isFlash) {
            if (tagView == null) {
                val textView = TextView(frameLayout.context).apply {
                    text = MARKER
                    textSize = 11f
                    setTextColor(Color.parseColor("#8A8A8E"))
                    gravity = Gravity.CENTER
                    tag = "FlashMarker"
                    layoutParams = FrameLayout.LayoutParams(
                        FrameLayout.LayoutParams.WRAP_CONTENT,
                        FrameLayout.LayoutParams.WRAP_CONTENT
                    ).apply {
                        gravity = Gravity.BOTTOM or Gravity.CENTER_HORIZONTAL
                        bottomMargin = (4 * frameLayout.resources.displayMetrics.density).toInt()
                    }
                }
                frameLayout.addView(textView)
            } else {
                tagView.visibility = View.VISIBLE
            }
        } else {
            tagView?.visibility = View.GONE
        }
    }
}