#!/bin/bash

wsurl='www.upch.edu.pe/wsmods/getGridValue.php'
#wsurl='172.17.12.22/ws/getGridValue.php'
endpoint=e1f3c916-fca7-4a28-9c60-41b051999cbc
curl "${wsurl}?endpointID=${endpoint}"
