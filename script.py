table = "person"
filename = table+".sql"
f = open(filename, 'w')
query = ""
for i in range(100):
	k = str(i)
	query = query + "INSERT INTO "+table+" VALUES('user"+k+"@gmail.com', 'user"+k+"', 1234567890, 1234-43213-1231-12312, 'pass"+k+"');\n"
f.write(query)