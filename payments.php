Classic TEST API Credentials
Username:
laaptulaaptu1-facilitator_api1.gmail.com
Password:
P85V3GV3QP3CRGWT
Signature:
AFcWxV21C7fd0v3bYYYRCpSSRl31AZrpCk2QdtandArP56WOGa19s1ur


{
'grant_type':'client_credentials',
'client_id':'laaptulaaptu1-facilitator_api1.gmail.com',
'secret':'P85V3GV3QP3CRGWT'
}

SELECT * FROM `ordertablenew` as otn, `usertable` as ut WHERE otn.userid = ut.userId and ut.emailId != 'pvr1@gmail.com'