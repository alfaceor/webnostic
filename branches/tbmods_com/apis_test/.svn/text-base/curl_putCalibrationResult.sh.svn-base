#!/bin/bash

#!/bin/bash
# @author: Carlos Olivares
# @email: alfaceor@gmail.com
# @description: Save the value of the calibration with the putCalibrationJob API

cluster_public_key="cluster_endpoint_public_key"

# Parameters to send in the POST
calibration_id=$1
value=0.77

# random seed
rand_message=478589

# key generation
signature=`python hmac_sha1_test.py ${cluster_public_key} ${calibration_id} ${value} ${rand_message}`
echo ${cluster_public_key}${calibration_id}${value}${rand_message}${signature}
# echo ${signature}
webservice_url="http://localhost/webnostic/app/index.php/api/calibration/putCalibrationResult"

# Send message.
curl -F rand_message=${rand_message} -F calibration_id=${calibration_id} -F value=${value} -F cluster_public_key=${cluster_public_key} -F signature=${signature} ${webservice_url}
