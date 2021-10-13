#!/bin/bash

#!/bin/bash
# @author: Carlos Olivares
# @email: alfaceor@gmail.com
# @description: Obtain a zip file from Webnostic with the getSampleJob API

cluster_public_key="cluster_endpoint_public_key"

# random seed
rand_message=4562168

# key generation
signature=`python hmac_sha1_test.py ${cluster_public_key} ${rand_message}`
# echo ${cluster_public_key}${rand_message}${signature}
webservice_url="http://localhost/webnostic/app/index.php/api/sample/getSampleJob"

# Send message.
curl -F rand_message=${rand_message} -F cluster_public_key=${cluster_public_key} -F signature=${signature} ${webservice_url} > archivoSample.zip
