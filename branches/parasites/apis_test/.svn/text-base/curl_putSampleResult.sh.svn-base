#!/bin/bash
# @author: Carlos Olivares
# @email: alfaceor@gmail.com
# @description: Save the sample result and score in the Webnostic WS with the getCalibrationJob API

cluster_public_key="cluster_endpoint_public_key"

# Parameters to send in the POST
sample_id=$1

trichu_result=1
trichu_score=0.97
diphy_result=0
diphy_score=0.30
fascio_result=0
fascio_score=0.22
taenia_result=0
taenia_score=0.05

# random seed
rand_message=56486

# key generation
signature=`python hmac_sha1_test.py ${cluster_public_key} ${sample_id} ${trichu_result} ${trichu_score} ${diphy_result} ${diphy_score} ${fascio_result} ${fascio_score} ${taenia_result} ${taenia_score} ${rand_message}`
echo ${signature}
webservice_url="http://localhost/webnostic-parasites/app/index.php/api/sample/putSampleResult"

# Send message.
curl -F rand_message=${rand_message} \
	-F sample_id=${sample_id} \
	-F trichu_result=${trichu_result} \
	-F trichu_score=${trichu_score} \
	-F diphy_result=${diphy_result} \
	-F diphy_score=${diphy_score} \
	-F fascio_result=${fascio_result} \
	-F fascio_score=${fascio_score} \
	-F taenia_result=${taenia_result} \
	-F taenia_score=${taenia_score} \
	-F cluster_public_key=${cluster_public_key} \
	-F signature=${signature} \
	${webservice_url}
