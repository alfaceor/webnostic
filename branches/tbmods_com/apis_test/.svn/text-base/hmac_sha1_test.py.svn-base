# @author: Carlos olivares
# @email: alfaceor@gmail.com
# @license: GPL v3
# @description: Generate HMAC hash using sha1 algorithm.

import sys
import hmac	
import time
import hashlib

# Global Variable.
cluster_public_key='cluster_endpoint_public_key'
cluster_private_key='cluster_endpoint_private_key'
# Function to encript message.
def make_digest(message):
    "Return a digest for the message."
    return hmac.new(cluster_private_key, message, hashlib.sha1).hexdigest()
messg=''
for arg in sys.argv[1:]:
	messg=messg+str(arg)
# print messg
print make_digest(messg)

