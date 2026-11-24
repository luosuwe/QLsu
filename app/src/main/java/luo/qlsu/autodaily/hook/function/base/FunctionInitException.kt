package luo.qlsu.autodaily.hook.function.base

import luo.qlsu.autodaily.utils.BaseException

class FunctionInitException : BaseException {

    constructor(message: String) : super(message)

    constructor(message: String, cause: Throwable) : super(message, cause)
}