/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/2.
 */
var bank58Validator = {
    "username":/^[a-z\_\d]{4,30}$/,
    "password":/^\S{6,15}$/,
    "mobile":/^1[34578]{1}\d{9}$/,
    "email":/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/,
    "idcard":/^[1-9]{1}\d{5}[12]{1}[0-9]{3}\d{7}[\dx]{1}$/i,
    "bankcard":/^[1-9]{1}\d{15,18}$/,
};
