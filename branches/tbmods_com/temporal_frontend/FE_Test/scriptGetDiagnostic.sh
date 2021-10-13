#!/bin/bash

# wsurl='www.upch.edu.pe/wsmods/getResult.php'
wsurl='192.168.122.49:8080/ws/getResult.php'
# wsurl='172.17.12.22/ws/getResult.php'
endpoint=e1f3c916-fca7-4a28-9c60-41b051999cbc
curl "${wsurl}?endpointID=${endpoint}"
