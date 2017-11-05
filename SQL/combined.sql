DROP TABLE complete_ride;
DROP TABLE bid;
DROP TABLE ride;
DROP TABLE car;
DROP TABLE person;CREATE TABLE person (
	email VARCHAR(64) PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	phone NUMERIC NOT NULL,	
	creditcard VARCHAR(64),
	password VARCHAR(64) NOT NULL,
	is_admin BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE car(
	carid VARCHAR(64) PRIMARY KEY,
	model VARCHAR(64) NOT NULL,
	color VARCHAR(64) NOT NULL,
	capacity NUMERIC NOT NULL,
	owner VARCHAR(64) REFERENCES person(email) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE ride(
	carid VARCHAR(64) REFERENCES car(carid) ON UPDATE CASCADE ON DELETE CASCADE,
	time_stamp TIMESTAMP,
	origin VARCHAR(64) NOT NULL,
	destination VARCHAR(64) NOT NULL,
	price NUMERIC NOT NULL,
	rideid NUMERIC PRIMARY KEY,
	UNIQUE(carid,time_stamp)
);

CREATE TABLE bid(
	client VARCHAR(64) REFERENCES person(email) ON UPDATE CASCADE ON DELETE CASCADE,
	bid_price NUMERIC NOT NULL,
	rideid NUMERIC REFERENCES ride(rideid) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY(rideid,client),
	UNIQUE(rideid,bid_price)
);

CREATE TABLE complete_ride(
	rideid NUMERIC PRIMARY KEY,
	client VARCHAR(64),
	FOREIGN KEY(rideid,client) REFERENCES bid(rideid,client) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE VIEW ride_price AS 
SELECT distinct r.price , r.carid, r.time_stamp, r.origin, r.destination, r.rideid, b.bid_price, 			b.client
FROM ride r LEFT OUTER JOIN bid b
ON (r.rideid = b.rideid 
AND b.bid_price >= ALL(SELECT b2.bid_price FROM bid b2 WHERE b2.rideid = r.rideid)
AND b.bid_price >= r.price);
INSERT INTO person VALUES('user0@gmail.com', 'user0', 7088540646, '1234-43213-1231-12312', 'cb71cd3f59909532b783257f5f97d0502af258231f9d17cbe762799c0bb4a0f6', FALSE);
INSERT INTO person VALUES('user1@gmail.com', 'user1', 8593938487, '1234-43213-1231-12312', 'e6c3da5b206634d7f3f3586d747ffdb36b5c675757b380c6a5fe5c570c714349', FALSE);
INSERT INTO person VALUES('user2@gmail.com', 'user2', 1298304114, '1234-43213-1231-12312', '1ba3d16e9881959f8c9a9762854f72c6e6321cdd44358a10a4e939033117eab9', FALSE);
INSERT INTO person VALUES('user3@gmail.com', 'user3', 1549629843, '1234-43213-1231-12312', '3acb59306ef6e660cf832d1d34c4fba3d88d616f0bb5c2a9e0f82d18ef6fc167', FALSE);
INSERT INTO person VALUES('user4@gmail.com', 'user4', 3053682673, '1234-43213-1231-12312', 'a417b5dc3d06d15d91c6687e27fc1705ebc56b3b2d813abe03066e5643fe4e74', FALSE);
INSERT INTO person VALUES('user5@gmail.com', 'user5', 2123176707, '1234-43213-1231-12312', '0eeac8171768d0cdef3a20fee6db4362d019c91e10662a6b55186336e1a42778', FALSE);
INSERT INTO person VALUES('user6@gmail.com', 'user6', 6309152415, '1234-43213-1231-12312', '5c4950c94a3461441c356afa783f76b83b38fd65f730f291403efbcc798acc1f', FALSE);
INSERT INTO person VALUES('user7@gmail.com', 'user7', 5778716332, '1234-43213-1231-12312', '1526f5e0e31d42fe1c3664ce923ac22ac1333417a90b32043797ac454cd03112', FALSE);
INSERT INTO person VALUES('user8@gmail.com', 'user8', 9747064563, '1234-43213-1231-12312', 'c8fea5b0b76dc690feaf5544749f99b40e78e2a37c0e867a086696509416302a', FALSE);
INSERT INTO person VALUES('user9@gmail.com', 'user9', 9384377471, '1234-43213-1231-12312', '2d4589473fb3f4581d7452cd25182159d68d2a50056a0cce35a529b010e32f2b', FALSE);
INSERT INTO person VALUES('user10@gmail.com', 'user10', 3063130129, '1234-43213-1231-12312', 'b35892cb8b089e03e4420b94df688122a2b76d4ad0f8b94ad20808bb029e48a5', FALSE);
INSERT INTO person VALUES('user11@gmail.com', 'user11', 6859704048, '1234-43213-1231-12312', '8057f787ebd8b4f9d40f53d7fbbfcbdde7067c1a074435b68f525b3de0e2ac2b', FALSE);
INSERT INTO person VALUES('user12@gmail.com', 'user12', 2647300549, '1234-43213-1231-12312', 'fdac810d0c09f25c5ddcee9976ab1f1ae1973dba7c65152d95b0937bc2a6c883', FALSE);
INSERT INTO person VALUES('user13@gmail.com', 'user13', 9416154932, '1234-43213-1231-12312', '1e53de2a2b4ab888cc24002ef8832d433b21956ab83ddeef989c8224b5c8f9f2', FALSE);
INSERT INTO person VALUES('user14@gmail.com', 'user14', 7993871138, '1234-43213-1231-12312', 'b78f24953963ac5ed773d6ec83120e3b1a65510201dc09ed2ed9e9781ba88870', FALSE);
INSERT INTO person VALUES('user15@gmail.com', 'user15', 2943096988, '1234-43213-1231-12312', 'b5a4ec869015095060b1171791334513f741177c4011e2c5c36e3e37a5ff8e5f', FALSE);
INSERT INTO person VALUES('user16@gmail.com', 'user16', 7629405765, '1234-43213-1231-12312', 'f0c28ba3fd9e0dcdcd0470acfcb98cc5a58d7d93422dbbefb930455ef714c87d', FALSE);
INSERT INTO person VALUES('user17@gmail.com', 'user17', 8598495258, '1234-43213-1231-12312', '4a6b7fa040bcfc734a113fee84d3789c0a626d70d029afad0d1c3e7b6c562e14', FALSE);
INSERT INTO person VALUES('user18@gmail.com', 'user18', 7642411035, '1234-43213-1231-12312', 'b99ddd77e59c96b13b64b3abe1902db4c0a76dabf8622aa6c71f8f5670be6625', FALSE);
INSERT INTO person VALUES('user19@gmail.com', 'user19', 6814264391, '1234-43213-1231-12312', '871431053023291d24b403f1f9d761c6f01b3050a0a83cd9d9759a970f8d4d92', FALSE);
INSERT INTO person VALUES('user20@gmail.com', 'user20', 3477559919, '1234-43213-1231-12312', '51d11024031a8951b4722671adfc8587538f5e5417206e7862e60752758a5c35', FALSE);
INSERT INTO person VALUES('user21@gmail.com', 'user21', 3462784867, '1234-43213-1231-12312', '2d6b3bb57cb9e22fa36516172ef096b30ae00d08eedc1499c599b6269975521d', FALSE);
INSERT INTO person VALUES('user22@gmail.com', 'user22', 8528467359, '1234-43213-1231-12312', 'd0f82756c4d40d20e1fdbc90cf4da4adff02fe23b355687525880514642f764e', FALSE);
INSERT INTO person VALUES('user23@gmail.com', 'user23', 5066825374, '1234-43213-1231-12312', '8893186d24cce07e1c82f2e020d41177e699318b4be9535483fdf55edf58cd50', FALSE);
INSERT INTO person VALUES('user24@gmail.com', 'user24', 1688257607, '1234-43213-1231-12312', 'cafdc894eacc597ad76db1a750ccb876d4ed69c73b7d3d23f5e3a9e3b5c9fc2e', FALSE);
INSERT INTO person VALUES('user25@gmail.com', 'user25', 8085898817, '1234-43213-1231-12312', '0028e1c0d2c60966390545414567d33bca9f0165fece6d0109c59a3f29b5fdd0', FALSE);
INSERT INTO person VALUES('user26@gmail.com', 'user26', 1087841721, '1234-43213-1231-12312', '45e17065ddc6fb3a682f7732df5804652952dbe1f5ca5377a661515a8fcf66be', FALSE);
INSERT INTO person VALUES('user27@gmail.com', 'user27', 6611861888, '1234-43213-1231-12312', '43b3ec9ea3961a319d37b4cc775d3f43f68709b62a93db10dd6c598137f28732', FALSE);
INSERT INTO person VALUES('user28@gmail.com', 'user28', 1862814757, '1234-43213-1231-12312', '034a0cdf079dfa3ca924e07e3c509bbf50768d1949b021c0ea0030cff80ba4d1', FALSE);
INSERT INTO person VALUES('user29@gmail.com', 'user29', 8164855118, '1234-43213-1231-12312', '53f6f072e26d36b9e55d5dc828872856d5286f18ce3818d367f9e4473e464a66', FALSE);
INSERT INTO person VALUES('user30@gmail.com', 'user30', 2047622182, '1234-43213-1231-12312', '85fcbe6bf830f23209ea6a932921e8da31a653a24a20cb84e75c4997e505690b', FALSE);
INSERT INTO person VALUES('user31@gmail.com', 'user31', 8140178419, '1234-43213-1231-12312', '3b3ad733c8571384c133694595c33d96c638b36f08a484bd0ad38bf312fdb294', FALSE);
INSERT INTO person VALUES('user32@gmail.com', 'user32', 8888519799, '1234-43213-1231-12312', '451a8149ebd58dbd064e3337c6de5d4f4bb08cd70bbbd48d62a205bd706b6bb0', FALSE);
INSERT INTO person VALUES('user33@gmail.com', 'user33', 3523909842, '1234-43213-1231-12312', '0756810289814362efbea8bb826fea0a7bc4318a7f22a4b27b48290cd39951a3', FALSE);
INSERT INTO person VALUES('user34@gmail.com', 'user34', 2750074686, '1234-43213-1231-12312', '94cd5db06baf087fd56c0042adc1deb162d271acfb8b3eb0277069517998d489', FALSE);
INSERT INTO person VALUES('user35@gmail.com', 'user35', 9524195809, '1234-43213-1231-12312', '5a66c7ba1398dd71c92a77cc7647c4183e6bf97b227e441bb2674a319b184e63', FALSE);
INSERT INTO person VALUES('user36@gmail.com', 'user36', 5430351779, '1234-43213-1231-12312', '133f8a05107e5442771c85da3dec70050ae5f3273849326b4a4e2ceaab2ef058', FALSE);
INSERT INTO person VALUES('user37@gmail.com', 'user37', 7336841806, '1234-43213-1231-12312', '1a31ac086ebf1341c916929e6d982767cd8568887d7c930ba8abd062afa08eac', FALSE);
INSERT INTO person VALUES('user38@gmail.com', 'user38', 8444285683, '1234-43213-1231-12312', 'b64171fda74426604480b9bf7c10ccdc2ebc80266c8667c42346f54ce87d4dec', FALSE);
INSERT INTO person VALUES('user39@gmail.com', 'user39', 1295358164, '1234-43213-1231-12312', '099646084abbbc2c403c480bea87e7de23ce18db73a3e28251effef3ed49f1ea', FALSE);
INSERT INTO person VALUES('user40@gmail.com', 'user40', 8189589967, '1234-43213-1231-12312', 'd88a53cd8ffe65ab18d2c62882479559aa781642ce7a8d340b22fc0a637b0359', FALSE);
INSERT INTO person VALUES('user41@gmail.com', 'user41', 4441970902, '1234-43213-1231-12312', 'a8a5146b1f97c2c8987ccb3a87d2f30b8aa258c2a32cb96115bf381d42df875c', FALSE);
INSERT INTO person VALUES('user42@gmail.com', 'user42', 6818733271, '1234-43213-1231-12312', 'de3543c757d459090b9adaf9a80a54d54724a0f1600d4c77d6017dde58cf1189', FALSE);
INSERT INTO person VALUES('user43@gmail.com', 'user43', 7742280214, '1234-43213-1231-12312', 'db9aa0719dbf5cac40e44b268042014e9bc28b4134df9051a35f8c64f6603b6f', FALSE);
INSERT INTO person VALUES('user44@gmail.com', 'user44', 9344422900, '1234-43213-1231-12312', '147eb7dd0f4c59120be8adb20f9dc4d4a0ccb27a0d48d7546dfa171dd980f075', FALSE);
INSERT INTO person VALUES('user45@gmail.com', 'user45', 8473948338, '1234-43213-1231-12312', '64bf83fcf172a284e3db6b4cc76bb175184ee9dd57e77f0421e3e401ea3858e0', FALSE);
INSERT INTO person VALUES('user46@gmail.com', 'user46', 7004683670, '1234-43213-1231-12312', '3f1b954c84d8216e09ae793664571dedb1e1bcc9a2bfdc2b6dc58db9a24fa7de', FALSE);
INSERT INTO person VALUES('user47@gmail.com', 'user47', 6239184853, '1234-43213-1231-12312', 'dbb70b94b6b192a1085e8056872daa4eb24002d47c82e88b1323f1a5882567ba', FALSE);
INSERT INTO person VALUES('user48@gmail.com', 'user48', 5777117801, '1234-43213-1231-12312', 'ffe4daf45af0e803fbe1fba2de5c7f7644f30b71ddb082100779d7884e0291c2', FALSE);
INSERT INTO person VALUES('user49@gmail.com', 'user49', 4243400896, '1234-43213-1231-12312', 'a0c69ae7ad7629347d41a89d9a558b26bd9b126a3a183f3498444843acd7270d', FALSE);
INSERT INTO person VALUES('user50@gmail.com', 'user50', 6797274922, '1234-43213-1231-12312', 'be46e03449534372e45f1abf511f78148625cf11d99f2f550e2f32b3a551dfb6', FALSE);
INSERT INTO person VALUES('user51@gmail.com', 'user51', 8941654371, '1234-43213-1231-12312', 'cc35e4b303c84633f2e64c1fe30a9c2f9e0f1dcdd53d1a748451b83164db475a', FALSE);
INSERT INTO person VALUES('user52@gmail.com', 'user52', 7526717255, '1234-43213-1231-12312', 'f511f615cd867553edd2fc66f4dc34441851f699cc1457f767c5ec0bad8cd250', FALSE);
INSERT INTO person VALUES('user53@gmail.com', 'user53', 2235227994, '1234-43213-1231-12312', 'f75b853a4521962ca5d349e4ca4cb69dce2dbfef61731cb9d14f1f2f1b6499fe', FALSE);
INSERT INTO person VALUES('user54@gmail.com', 'user54', 5267971489, '1234-43213-1231-12312', 'db383db8666c1c7f372e49b801a0405e0dd4193ab772163521b16e78879fa334', FALSE);
INSERT INTO person VALUES('user55@gmail.com', 'user55', 8517984809, '1234-43213-1231-12312', 'd6f7adababfd90706cc787591cdaf547f91d53abcb9008a180d90fc3d4f651e2', FALSE);
INSERT INTO person VALUES('user56@gmail.com', 'user56', 3010318163, '1234-43213-1231-12312', 'bacb5d03bee1af445b7cc73ba8db52a7fc01d474327c87899831ffe3b4c3543b', FALSE);
INSERT INTO person VALUES('user57@gmail.com', 'user57', 1866895446, '1234-43213-1231-12312', '3b356cdbaeb3d03a6b6f713a048489d62fd63b4a8fd0c70a976cb0b70c119e46', FALSE);
INSERT INTO person VALUES('user58@gmail.com', 'user58', 6148503028, '1234-43213-1231-12312', 'daa7c4bc3f1506b52b2bcc7864db9a96aee3ec1a8a68b29c5db60de1f8a6918b', FALSE);
INSERT INTO person VALUES('user59@gmail.com', 'user59', 2506837168, '1234-43213-1231-12312', 'e5e0e771c99778aef6f0046adb86a3d3e3ede2c68f43aae6b4ee9d498709328b', FALSE);
INSERT INTO person VALUES('user60@gmail.com', 'user60', 4271770652, '1234-43213-1231-12312', '598ed9422e3d9c328f48cafc2c66a66a3d393b64290f7741d60e6e22c03ca031', FALSE);
INSERT INTO person VALUES('user61@gmail.com', 'user61', 8422968945, '1234-43213-1231-12312', 'da3df0f1c138cc7b9e79e218587a605e12b7a9b9ac24e1287da5ed056cf10c22', FALSE);
INSERT INTO person VALUES('user62@gmail.com', 'user62', 8877647969, '1234-43213-1231-12312', '9b857dc1d1dc03b131bdb429b972f5f28c7d72b8466a22d54c359c48d19551fe', FALSE);
INSERT INTO person VALUES('user63@gmail.com', 'user63', 5077979441, '1234-43213-1231-12312', '7e251ea07d59cd5fc9d7d1dc4225104e474b93d6c6881797dfbfa010774d4acb', FALSE);
INSERT INTO person VALUES('user64@gmail.com', 'user64', 8907076897, '1234-43213-1231-12312', '51031e17ce0a58242bf97f01a2883d077c6dd21f22674ee500dbfb60228851e7', FALSE);
INSERT INTO person VALUES('user65@gmail.com', 'user65', 4922142811, '1234-43213-1231-12312', '3c62426f46ebb414ff53540c6f1af32639c28b434126ae98b9f1651dd5e4fd4a', FALSE);
INSERT INTO person VALUES('user66@gmail.com', 'user66', 8861184753, '1234-43213-1231-12312', '06599c96e52ff54f21e65cec89df4b96ce519704136d6f7246a56be613eed8fb', FALSE);
INSERT INTO person VALUES('user67@gmail.com', 'user67', 3716034653, '1234-43213-1231-12312', '8a110e75a8142ab756babe02160548ed6c254ae3fd931b297aa4edba91065732', FALSE);
INSERT INTO person VALUES('user68@gmail.com', 'user68', 8807955073, '1234-43213-1231-12312', '5a583fab00aa1c17acaad80b2b9b5a16a8563e7e66808bf4b4acbfb55d9b85d4', FALSE);
INSERT INTO person VALUES('user69@gmail.com', 'user69', 9262432568, '1234-43213-1231-12312', '667d45d6d55c4fe6a7239bb554854e3b8fc0b392abea73864e91104bb1b4581d', FALSE);
INSERT INTO person VALUES('user70@gmail.com', 'user70', 3259136572, '1234-43213-1231-12312', '44b6dadf9835ff29d5342da14dfaf76e3d828081a1704b131baa355f950e6047', FALSE);
INSERT INTO person VALUES('user71@gmail.com', 'user71', 2002066388, '1234-43213-1231-12312', 'a06afaf373a81a1bcd1641fdd0f8b9c2c0d7104171abafbd80d11e933a9c6a13', FALSE);
INSERT INTO person VALUES('user72@gmail.com', 'user72', 8439849511, '1234-43213-1231-12312', '79db1e22563af60be55a3717827926b76139d2428cbe693eba1643c2798e048d', FALSE);
INSERT INTO person VALUES('user73@gmail.com', 'user73', 3711922463, '1234-43213-1231-12312', '25ac9b17f8113ceda4e3b18b639ac0c5821fa6cf61e31a4b2cafec4573b89522', FALSE);
INSERT INTO person VALUES('user74@gmail.com', 'user74', 6349387295, '1234-43213-1231-12312', 'efacf97ed63d8d618e5c1f03e2fbd3656ed4c97ba04abf6db791534b425641c2', FALSE);
INSERT INTO person VALUES('user75@gmail.com', 'user75', 3778414523, '1234-43213-1231-12312', 'aaa88f12093ddca8064cdb97bf7635d7cd82c94d264121133f79f24e9b645bf1', FALSE);
INSERT INTO person VALUES('user76@gmail.com', 'user76', 9179783991, '1234-43213-1231-12312', '55e315face2c7bcfc4b1d43be3a863e3bbb565ad3dafe30a9dd45b51b190be9d', FALSE);
INSERT INTO person VALUES('user77@gmail.com', 'user77', 3462884858, '1234-43213-1231-12312', '2590d18604c282ff195459db33d0ae2caab98b14d4cbfdfd4dc3ed4923bf31b8', FALSE);
INSERT INTO person VALUES('user78@gmail.com', 'user78', 1783030678, '1234-43213-1231-12312', '70dfb731f9ecfb0c9015b28838281e2a3cde900a791c45532154ddb5a95ed31b', FALSE);
INSERT INTO person VALUES('user79@gmail.com', 'user79', 6127020015, '1234-43213-1231-12312', 'f46c534ea1cb330122334be00303592a10bcbbc238d1b11e1b498d4486d13755', FALSE);
INSERT INTO person VALUES('user80@gmail.com', 'user80', 6467927945, '1234-43213-1231-12312', 'a5276c24114971eceb4d5149894034741bcf22825b30c39942ff63007e031956', FALSE);
INSERT INTO person VALUES('user81@gmail.com', 'user81', 6175998200, '1234-43213-1231-12312', '7137bc5132a11c4937a830c4f594a551b18d0764f66f8478de3db48377f2b611', FALSE);
INSERT INTO person VALUES('user82@gmail.com', 'user82', 9961976357, '1234-43213-1231-12312', 'ca619acdadd8eb0f598c954031b5f359a2fbd4fe0179eb02acfeab2ad373c999', FALSE);
INSERT INTO person VALUES('user83@gmail.com', 'user83', 9171034642, '1234-43213-1231-12312', 'dd76076f40644e9e57f7459bfc37b2ef8b7084bda5a3127c24a62c86dd45eb0b', FALSE);
INSERT INTO person VALUES('user84@gmail.com', 'user84', 9858232787, '1234-43213-1231-12312', '11ee91bdbb90b967d18e45226bd3bc17d72a85a4486315b3568d070722445fe1', FALSE);
INSERT INTO person VALUES('user85@gmail.com', 'user85', 9095568826, '1234-43213-1231-12312', 'cfecdf5846f8e8279f4dcf79a2135308e11c0d283175a2fb79b33b76f487cb24', FALSE);
INSERT INTO person VALUES('user86@gmail.com', 'user86', 9293404697, '1234-43213-1231-12312', '3c0c8e2f0527574ed275f4fc831af606b283370490f9c39c7389fb5d16dd6ac8', FALSE);
INSERT INTO person VALUES('user87@gmail.com', 'user87', 5559254418, '1234-43213-1231-12312', '4a2efe616f41f27f583d7e1e628a7b019f2b2603677ae0216d14559eefb83975', FALSE);
INSERT INTO person VALUES('user88@gmail.com', 'user88', 5453898837, '1234-43213-1231-12312', '1d45a36925bcb8f729f8f06ee0ec689f440cc6b08c3a0573ed12e10104e1e9a0', FALSE);
INSERT INTO person VALUES('user89@gmail.com', 'user89', 1120669186, '1234-43213-1231-12312', '9d57ee06aac896609727855add2cfc3d9c50cd545395974cdee219c91e29fd25', FALSE);
INSERT INTO person VALUES('user90@gmail.com', 'user90', 5254436585, '1234-43213-1231-12312', 'a4273f882cab7a89e7fa8e5a1298799b62233ada8a93f880f58bbd87db44d6a3', FALSE);
INSERT INTO person VALUES('user91@gmail.com', 'user91', 4252416517, '1234-43213-1231-12312', '7f6ceca338f7fe1bb409870c95cbf5009115df953af77a91ef912a11cf6423c7', FALSE);
INSERT INTO person VALUES('user92@gmail.com', 'user92', 5492903281, '1234-43213-1231-12312', '905026a6ddab21a9d1dca17cc4f47b843eccd1c4806f7f3c59b88cdac12e339f', FALSE);
INSERT INTO person VALUES('user93@gmail.com', 'user93', 1962111528, '1234-43213-1231-12312', '3dcc4d43a91ae471be9fb0dfb7e7a44dcbaf8125b389d65d38604ec5582825ec', FALSE);
INSERT INTO person VALUES('user94@gmail.com', 'user94', 1595739675, '1234-43213-1231-12312', '3fdd6e2fcae488c7c7818992ad08249cd0f6576f6ff846bcecaa816e002cde3c', FALSE);
INSERT INTO person VALUES('user95@gmail.com', 'user95', 6722341571, '1234-43213-1231-12312', 'b3f20ff60a6e1eda26f8c412e7173c7ee7f5b3a1124b87a38d3deb63274c1a61', FALSE);
INSERT INTO person VALUES('user96@gmail.com', 'user96', 6312413259, '1234-43213-1231-12312', '38ee64c8e2536e41e2543266f6a5216747b24c8b8ada7d5f7cfba8b1e80752fb', FALSE);
INSERT INTO person VALUES('user97@gmail.com', 'user97', 6930723122, '1234-43213-1231-12312', '7f5106053c87018f57187a0a485dedacb2ef37f08f05ab2313f23217a9ee928b', FALSE);
INSERT INTO person VALUES('user98@gmail.com', 'user98', 5413657671, '1234-43213-1231-12312', '125e175312b42ca54475207f1ad47df9ac421dd758fcc5c2ab19ae31e451cc53', FALSE);
INSERT INTO person VALUES('user99@gmail.com', 'user99', 2047717187, '1234-43213-1231-12312', 'ab2f50fe825bc3a9a8b649f173af23be3a052db9b410fcb0127e50ae9c356ba7', FALSE);
INSERT INTO person VALUES('admin0@gmail.com', 'admin0', 4066664238, '1234-43213-1231-12312', '04890323ef89a1f72b7cff409bf4a0704c004e445d37ac86669f1c472c929034', TRUE);
INSERT INTO person VALUES('admin1@gmail.com', 'admin1', 9097944132, '1234-43213-1231-12312', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', TRUE);
INSERT INTO person VALUES('admin2@gmail.com', 'admin2', 4130555460, '1234-43213-1231-12312', '1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8', TRUE);
INSERT INTO person VALUES('admin3@gmail.com', 'admin3', 9105598484, '1234-43213-1231-12312', '4fc2b5673a201ad9b1fc03dcb346e1baad44351daa0503d5534b4dfdcc4332e0', TRUE);
INSERT INTO car VALUES('car0', 'model0', 'color0', 4, 'user60@gmail.com');
INSERT INTO car VALUES('car1', 'model1', 'color1', 2, 'user88@gmail.com');
INSERT INTO car VALUES('car2', 'model2', 'color2', 3, 'user89@gmail.com');
INSERT INTO car VALUES('car3', 'model3', 'color3', 1, 'user56@gmail.com');
INSERT INTO car VALUES('car4', 'model4', 'color4', 3, 'user56@gmail.com');
INSERT INTO car VALUES('car5', 'model5', 'color5', 2, 'user31@gmail.com');
INSERT INTO car VALUES('car6', 'model6', 'color6', 4, 'user86@gmail.com');
INSERT INTO car VALUES('car7', 'model7', 'color7', 2, 'user89@gmail.com');
INSERT INTO car VALUES('car8', 'model8', 'color8', 2, 'user69@gmail.com');
INSERT INTO car VALUES('car9', 'model9', 'color9', 1, 'user75@gmail.com');
INSERT INTO car VALUES('car10', 'model10', 'color10', 1, 'user44@gmail.com');
INSERT INTO car VALUES('car11', 'model11', 'color11', 1, 'user29@gmail.com');
INSERT INTO car VALUES('car12', 'model12', 'color12', 4, 'user6@gmail.com');
INSERT INTO car VALUES('car13', 'model13', 'color13', 3, 'user55@gmail.com');
INSERT INTO car VALUES('car14', 'model14', 'color14', 3, 'user79@gmail.com');
INSERT INTO car VALUES('car15', 'model15', 'color15', 3, 'user16@gmail.com');
INSERT INTO car VALUES('car16', 'model16', 'color16', 4, 'user38@gmail.com');
INSERT INTO car VALUES('car17', 'model17', 'color17', 2, 'user36@gmail.com');
INSERT INTO car VALUES('car18', 'model18', 'color18', 4, 'user36@gmail.com');
INSERT INTO car VALUES('car19', 'model19', 'color19', 1, 'user30@gmail.com');
INSERT INTO car VALUES('car20', 'model20', 'color20', 4, 'user26@gmail.com');
INSERT INTO car VALUES('car21', 'model21', 'color21', 3, 'user30@gmail.com');
INSERT INTO car VALUES('car22', 'model22', 'color22', 4, 'user36@gmail.com');
INSERT INTO car VALUES('car23', 'model23', 'color23', 3, 'user76@gmail.com');
INSERT INTO car VALUES('car24', 'model24', 'color24', 4, 'user68@gmail.com');
INSERT INTO car VALUES('car25', 'model25', 'color25', 4, 'user96@gmail.com');
INSERT INTO car VALUES('car26', 'model26', 'color26', 3, 'user49@gmail.com');
INSERT INTO car VALUES('car27', 'model27', 'color27', 4, 'user0@gmail.com');
INSERT INTO car VALUES('car28', 'model28', 'color28', 1, 'user82@gmail.com');
INSERT INTO car VALUES('car29', 'model29', 'color29', 3, 'user84@gmail.com');
INSERT INTO car VALUES('car30', 'model30', 'color30', 3, 'user37@gmail.com');
INSERT INTO car VALUES('car31', 'model31', 'color31', 2, 'user72@gmail.com');
INSERT INTO car VALUES('car32', 'model32', 'color32', 4, 'user13@gmail.com');
INSERT INTO car VALUES('car33', 'model33', 'color33', 2, 'user36@gmail.com');
INSERT INTO car VALUES('car34', 'model34', 'color34', 2, 'user46@gmail.com');
INSERT INTO car VALUES('car35', 'model35', 'color35', 1, 'user88@gmail.com');
INSERT INTO car VALUES('car36', 'model36', 'color36', 1, 'user33@gmail.com');
INSERT INTO car VALUES('car37', 'model37', 'color37', 3, 'user88@gmail.com');
INSERT INTO car VALUES('car38', 'model38', 'color38', 1, 'user56@gmail.com');
INSERT INTO car VALUES('car39', 'model39', 'color39', 2, 'user88@gmail.com');
INSERT INTO car VALUES('car40', 'model40', 'color40', 3, 'user1@gmail.com');
INSERT INTO car VALUES('car41', 'model41', 'color41', 4, 'user67@gmail.com');
INSERT INTO car VALUES('car42', 'model42', 'color42', 3, 'user22@gmail.com');
INSERT INTO car VALUES('car43', 'model43', 'color43', 3, 'user25@gmail.com');
INSERT INTO car VALUES('car44', 'model44', 'color44', 1, 'user36@gmail.com');
INSERT INTO car VALUES('car45', 'model45', 'color45', 4, 'user95@gmail.com');
INSERT INTO car VALUES('car46', 'model46', 'color46', 1, 'user16@gmail.com');
INSERT INTO car VALUES('car47', 'model47', 'color47', 1, 'user67@gmail.com');
INSERT INTO car VALUES('car48', 'model48', 'color48', 4, 'user73@gmail.com');
INSERT INTO car VALUES('car49', 'model49', 'color49', 1, 'user37@gmail.com');
INSERT INTO ride VALUES('car14', '2017-10-26 15:12:00', 'Sentosa', 'Utown', 4.00, 0);
INSERT INTO ride VALUES('car43', '2017-10-28 21:49:00', 'Kent Ridge', 'Clarke Quay', 4.00, 1);
INSERT INTO ride VALUES('car6', '2017-10-14 11:42:00', 'Singapore Zoo', 'Gardens By The Bay', 4.00, 2);
INSERT INTO ride VALUES('car25', '2017-10-16 21:39:00', 'Pulau Ubin', 'Utown', 4.00, 3);
INSERT INTO ride VALUES('car10', '2017-10-24 19:36:00', 'Little India', 'China Town', 4.00, 4);
INSERT INTO ride VALUES('car48', '2017-10-16 16:27:00', 'Utown', 'Pulau Ubin', 4.00, 5);
INSERT INTO ride VALUES('car9', '2017-10-29 20:30:00', 'China Town', 'Utown', 4.00, 6);
INSERT INTO ride VALUES('car47', '2017-10-21 21:46:00', 'Marina Bay', 'Sentosa', 4.00, 7);
INSERT INTO ride VALUES('car25', '2017-10-28 16:38:00', 'Marina Bay', 'Clarke Quay', 4.00, 8);
INSERT INTO ride VALUES('car13', '2017-10-25 19:25:00', 'Pulau Ubin', 'China Town', 4.00, 9);
INSERT INTO ride VALUES('car13', '2017-10-25 14:11:00', 'Marina Bay', 'Singapore Zoo', 4.00, 10);
INSERT INTO ride VALUES('car0', '2017-10-18 16:31:00', 'Kent Ridge', 'Utown', 4.00, 11);
INSERT INTO ride VALUES('car3', '2017-10-10 14:59:00', 'Sentosa', 'Little India', 4.00, 12);
INSERT INTO ride VALUES('car17', '2017-10-19 11:43:00', 'Kent Ridge', 'Little India', 4.00, 13);
INSERT INTO ride VALUES('car29', '2017-10-23 10:15:00', 'Singapore Zoo', 'Clarke Quay', 4.00, 14);
INSERT INTO ride VALUES('car30', '2017-10-24 14:40:00', 'Gardens By The Bay', 'Pulau Ubin', 4.00, 15);
INSERT INTO ride VALUES('car32', '2017-10-27 20:58:00', 'Utown', 'Gardens By The Bay', 4.00, 16);
INSERT INTO ride VALUES('car42', '2017-10-17 10:56:00', 'Utown', 'Clarke Quay', 4.00, 17);
INSERT INTO ride VALUES('car33', '2017-10-27 21:21:00', 'Pulau Ubin', 'Little India', 4.00, 18);
INSERT INTO ride VALUES('car8', '2017-10-22 11:23:00', 'Gardens By The Bay', 'Pulau Ubin', 4.00, 19);
INSERT INTO ride VALUES('car47', '2017-10-13 15:45:00', 'Singapore Zoo', 'Marina Bay', 4.00, 20);
INSERT INTO ride VALUES('car10', '2017-10-12 10:33:00', 'Kent Ridge', 'Utown', 4.00, 21);
INSERT INTO ride VALUES('car37', '2017-10-14 12:14:00', 'Utown', 'Little India', 4.00, 22);
INSERT INTO ride VALUES('car41', '2017-10-23 15:58:00', 'Utown', 'Pulau Ubin', 4.00, 23);
INSERT INTO ride VALUES('car0', '2017-10-24 13:36:00', 'Singapore Zoo', 'China Town', 4.00, 24);
INSERT INTO ride VALUES('car27', '2017-10-19 13:53:00', 'Marina Bay', 'Kent Ridge', 4.00, 25);
INSERT INTO ride VALUES('car21', '2017-10-18 23:55:00', 'Marina Bay', 'Little India', 4.00, 26);
INSERT INTO ride VALUES('car31', '2017-10-13 16:45:00', 'Marina Bay', 'Singapore Zoo', 4.00, 27);
INSERT INTO ride VALUES('car42', '2017-10-22 12:54:00', 'Kent Ridge', 'Little India', 4.00, 28);
INSERT INTO ride VALUES('car0', '2017-10-17 17:40:00', 'Gardens By The Bay', 'Kent Ridge', 4.00, 29);
INSERT INTO ride VALUES('car43', '2017-10-29 14:57:00', 'China Town', 'Sentosa', 4.00, 30);
INSERT INTO ride VALUES('car18', '2017-10-26 14:23:00', 'Sentosa', 'Pulau Ubin', 4.00, 31);
INSERT INTO ride VALUES('car15', '2017-10-14 16:22:00', 'Gardens By The Bay', 'Little India', 4.00, 32);
INSERT INTO ride VALUES('car48', '2017-10-17 13:44:00', 'Singapore Zoo', 'Sentosa', 4.00, 33);
INSERT INTO ride VALUES('car34', '2017-10-18 16:25:00', 'Utown', 'Sentosa', 4.00, 34);
INSERT INTO ride VALUES('car26', '2017-10-29 15:23:00', 'Clarke Quay', 'Kent Ridge', 4.00, 35);
INSERT INTO ride VALUES('car15', '2017-10-27 21:30:00', 'Pulau Ubin', 'Kent Ridge', 4.00, 36);
INSERT INTO ride VALUES('car7', '2017-10-21 13:45:00', 'China Town', 'Little India', 4.00, 37);
INSERT INTO ride VALUES('car1', '2017-10-28 18:28:00', 'Utown', 'Marina Bay', 4.00, 38);
INSERT INTO ride VALUES('car30', '2017-10-15 16:11:00', 'Gardens By The Bay', 'Sentosa', 4.00, 39);
INSERT INTO ride VALUES('car49', '2017-10-18 13:32:00', 'China Town', 'Utown', 4.00, 40);
INSERT INTO ride VALUES('car14', '2017-10-29 15:28:00', 'Pulau Ubin', 'Utown', 4.00, 41);
INSERT INTO ride VALUES('car8', '2017-10-19 13:59:00', 'Gardens By The Bay', 'Little India', 4.00, 42);
INSERT INTO ride VALUES('car19', '2017-10-29 12:53:00', 'Kent Ridge', 'Singapore Zoo', 4.00, 43);
INSERT INTO ride VALUES('car8', '2017-10-27 18:26:00', 'Singapore Zoo', 'China Town', 4.00, 44);
INSERT INTO ride VALUES('car4', '2017-10-27 11:42:00', 'Sentosa', 'Singapore Zoo', 4.00, 45);
INSERT INTO ride VALUES('car41', '2017-10-28 23:12:00', 'Little India', 'Pulau Ubin', 4.00, 46);
INSERT INTO ride VALUES('car36', '2017-10-11 13:36:00', 'Kent Ridge', 'Gardens By The Bay', 4.00, 47);
INSERT INTO ride VALUES('car2', '2017-10-12 17:14:00', 'Gardens By The Bay', 'China Town', 4.00, 48);
INSERT INTO ride VALUES('car32', '2017-10-25 14:53:00', 'Little India', 'China Town', 4.00, 49);
INSERT INTO bid VALUES('user20@gmail.com', 4.00, 13);
INSERT INTO bid VALUES('user14@gmail.com', 4.00, 47);
INSERT INTO bid VALUES('user93@gmail.com', 4.00, 8);
INSERT INTO bid VALUES('user85@gmail.com', 4.00, 13);
INSERT INTO bid VALUES('user81@gmail.com', 4.00, 11);
INSERT INTO bid VALUES('user5@gmail.com', 4.00, 8);
INSERT INTO bid VALUES('user0@gmail.com', 4.00, 44);
INSERT INTO bid VALUES('user58@gmail.com', 4.00, 25);
INSERT INTO bid VALUES('user92@gmail.com', 4.00, 44);
INSERT INTO bid VALUES('user19@gmail.com', 4.00, 30);
INSERT INTO bid VALUES('user39@gmail.com', 4.00, 24);
INSERT INTO bid VALUES('user46@gmail.com', 4.00, 23);
INSERT INTO bid VALUES('user72@gmail.com', 4.00, 6);
INSERT INTO bid VALUES('user40@gmail.com', 4.00, 19);
INSERT INTO bid VALUES('user92@gmail.com', 4.00, 2);
INSERT INTO bid VALUES('user37@gmail.com', 4.00, 16);
INSERT INTO bid VALUES('user62@gmail.com', 4.00, 8);
INSERT INTO bid VALUES('user13@gmail.com', 4.00, 9);
INSERT INTO bid VALUES('user87@gmail.com', 4.00, 8);
INSERT INTO bid VALUES('user42@gmail.com', 4.00, 44);
INSERT INTO bid VALUES('user79@gmail.com', 4.00, 29);
INSERT INTO bid VALUES('user25@gmail.com', 4.00, 3);
INSERT INTO bid VALUES('user7@gmail.com', 4.00, 37);
INSERT INTO bid VALUES('user0@gmail.com', 4.00, 21);
INSERT INTO bid VALUES('user12@gmail.com', 4.00, 39);
