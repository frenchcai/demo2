<?php
var https = require('https');
var request = require('request');
var Promise = require('promise');  //promise�������̿��ƣ�����֤�Ȼ�ȡ��access_token,�ڵ��ô����Զ���˵��ӿ�
 var appId='wx0f5ef167a14f12f2';
 var appSecret='6017a74588a107773a284a7557753da1';
//var appId = 'wx482687a49f5f45b3'; //�ǵû������Լ����Ժŵ���Ϣ
//var appSecret = 'aca22799b4549eaeaaacf6b652605c1a';

function getToKen(appId, appSecret) {        

    return new Promise(function (resolve, reject) {

        var url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' + appId + '&secret=' + appSecret;
        request({
            uri : url
        }, function (err, res, data) {
            var result = JSON.parse(data);
            console.log("result.access_token=", result);

            resolve(result.access_token);  //�ѻ�ȡ��access_token����ȥ
        });

    });

}

   //menuΪ�����Զ���˵��ľ������ݣ�Ҳ����post��΢�ŷ�������body
var menu = {          
    "button" : [{
            "name" : "�ҵ��˺�",
            "sub_button" : [{
                    "type" : "click",
                    "name" : "test1",
                    "key" : "V1001_MY_ACCOUNT"
                }, {
                    "type" : "click",
                    "name" : "test2",
                    "key" : "V1002_BID_PROJECTS"
                }, {
                    "type" : "click",
                    "name" : "test3",
                    "key" : "V1003_RETURN_PLAN"
                }, {
                    "type" : "click",
                    "name" : "test4",
                    "key" : "V1004_TRANS_DETAIL"
                }, {
                    "type" : "click",
                    "name" : "test5",
                    "key" : "V1005_REGISTER_BIND"
                }
            ]
        }, {
            "type" : "view",
            "name" : "�ٶ�",
            "url" : "http://www.baidu.com/"
        }, {

            "type" : "view",
            "name" : "���˲���",
            "url" : "http://blog.csdn.net/yezhenxu1992/"

        }
    ]
};

var post_str = new Buffer(JSON.stringify(menu));   //�Ƚ�menuת��JSON���ݸ�ʽ���ڸ���post_srt����

//console.log("JSON.stringify(menu)=", JSON.stringify(menu));
//console.log("post_str.toString()=", post_str.toString());
//console.log("post_str.length", post_str.length);


//����getToken������getToken����ִ���꣬��������ִ��then�����е���������,���У�access_tokenΪ�������Ĳ�����
//��promise�������̵�ԭ���������Ϥ�ļһ���Ʋ������������ر���Ҫ���������ڻ����¼����첽IO��nodejs�У��ܶ�ʱ�� �����ִ��˳�򲢷�˳��ִ�У����Ժ��б�Ҫ���ƴ�������̡�

getToKen(appId, appSecret).then(function (access_token)) {  
    var post_options = {
        host : 'api.weixin.qq.com',
        port : '443',
        path : '/cgi-bin/menu/create?access_token=' + access_token,
        method : 'POST',
        headers : {
            'Content-Type' : 'application/x-www-form-urlencoded',
            'Content-Length' : post_str.length
        }
    };

    var post_req = https.request(post_options, function (response) {
            var responseText = [];
            var size = 0;
            response.setEncoding('utf8');
            response.on('data', function (data) {
                responseText.push(data);
                size += data.length;
            });
            response.on('end', function () {
                console.log("responseText=", responseText);
            });
        });

    post_req.write(post_str);   // ��menu����post��΢�ŷ�������ʣ�µ�΢���Զ������Ǹ㶨�ˡ�
    post_req.end();
});

?>