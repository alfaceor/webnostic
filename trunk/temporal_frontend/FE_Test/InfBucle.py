#!/usr/bin/python
#Created by Ronald G.
import os
import simplejson
import MySQLdb
import string
while True:
	os.system("sh /var/www/tmp_web/temporal_frontend/FE_Test/scriptGetDiagnostic.sh>json.txt")
	f=open("/var/www/tmp_web/temporal_frontend/FE_Test/json.txt","r")
	json=f.read()
	json=simplejson.loads(json)
	cadena1="None"
	cadena2="Null"
	if (not((str(json['sampleID'])).lower()==cadena1.lower() or (str(json['sampleID'])).lower()==cadena2.lower())):
		print "Escribiendo en la DB";
		f.close()
		db='localhost'
		usuario='root'
		passw='upchlid'
		base_de_datos='tmp_frontend_db';
		diagnostic=json['diagnostic']
		score=json['sampleScore']
		os.system("date>date.txt")
		f=open("/var/www/tmp_web/temporal_frontend/FE_Test/date.txt","r")
		date=f.read()
		f.close()
		sampleid=json['sampleID']
		db=MySQLdb.connect(host=db,user=usuario,passwd=passw,db=base_de_datos)
		cursor=db.cursor()
		query="UPDATE	tbmods set diagnostic='"+str(diagnostic)+"', score="+str(score)+",status='Complete',time_get='"+str(date)+"' WHERE sampleid='"+str(sampleid)+"'"
		print query
		cursor.execute(query)
		db.commit()
		cursor.close()
	else:
		print "No hay resultados"
