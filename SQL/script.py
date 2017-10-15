import random
table = "person"
filename = table+".sql"
f = open(filename, 'w')
query = ""
for i in range(100):
	k = str(i)
	phone = random.randint(1000000000,9999999999)
	query = query + "INSERT INTO "+table+" VALUES('user"+k+"@gmail.com', 'user"+k+"', "+str(phone)+", '1234-43213-1231-12312', 'pass"+k+"');\n"
f.write(query)

table = "car"
filename = table+".sql"
f = open(filename, 'w')
query = ""
for i in range(50):
	x = random.randint(0,99)
	capacity = random.randint(1,4)
	k = str(i)
	query = query + "INSERT INTO "+table+" VALUES('car"+k+"', 'model"+k+"', 'color"+k+"', "+str(capacity)+", 'user"+str(x)+"@gmail.com');\n"
f.write(query)


table = "ride"
filename = table+".sql"
f = open(filename, 'w')
query = ""

# 2009-09-09 09:30:25 CET
year = "2017"
month = "10"
locations = ["Kent Ridge","Sentosa","China Town","Little India","Marina Bay",
				"Gardens By The Bay","Pulau Ubin","Singapore Zoo","Clarke Quay","Utown"]
for i in range(50):
	k = str(i)
	date = str(random.randint(10,29))
	hour = str(random.randint(10,23))
	minute = str(random.randint(10,59))
	second = str(random.randint(10,59))
	carid = random.randint(0,49)
	origin = random.randint(0,9)
	destination = random.randint(0,9)
	while origin == destination:
		destination = random.randint(0,9)
	query = query + "INSERT INTO "+table+" VALUES('car"+str(carid)+"', '"+year+"-"+month+"-"+date+" "+hour+":"+minute+":" +second+" GMT', '"+locations[origin]+"', '"+locations[destination]+"', 4.00, 'ride"+k+"');\n"
f.write(query)


table = "complete_ride"
filename = table+".sql"
f = open(filename, 'w')
query = ""
for i in range(25):
	rideid = random.randint(0,49)
	userid = random.randint(0,99)
	query = query + "INSERT INTO "+table+" VALUES('user"+str(userid)+"@gmail.com', 4.00, 'ride"+str(rideid)+"');\n"
f.write(query)

table = "bid"
filename = table+".sql"
f = open(filename, 'w')
query = ""
for i in range(25):
	rideid = random.randint(0,49)
	userid = random.randint(0,99)
	query = query + "INSERT INTO "+table+" VALUES('user"+str(userid)+"@gmail.com', 4.00, 'ride"+str(rideid)+"');\n"
f.write(query)

