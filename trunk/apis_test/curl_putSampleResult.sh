#!/bin/bash
# @author: Carlos Olivares
# @email: alfaceor@gmail.com
# @description: Save the sample result and score in the Webnostic WS with the getCalibrationJob API

cluster_public_key="cluster_endpoint_public_key"

# Parameters to send in the POST
sample_id=$1
score=0.97
result=1

# random seed
rand_message=56486

# key generation
signature=`python hmac_sha1_test.py ${cluster_public_key} ${sample_id} ${score} ${result} ${rand_message}`
echo ${signature}
webservice_url="http://localhost/webnostic/app/index.php/api/sample/putSampleResult"

# Send message.
curl -F rand_message=${rand_message} \
	-F sample_id=${sample_id} \
	-F score=${score} \
	-F result=${result} \
	-F cluster_public_key=${cluster_public_key} \
	-F signature=${signature} \
	${webservice_url}
