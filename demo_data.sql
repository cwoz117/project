USE truckco;

-- Companies
insert into User VALUES(1,'vader','anakin',"Daddy issues cause me to be a terrible father myself", 1),
                       (2,'leigh','skywalker',"I'm just running the resistance and trying to stay relevant", 1),
                       (3,'lando','calrissian',"I'm not that bad a guy", 1);

insert into Company VALUES(1, "The Empire", 1234, "1 Coruscant Dr."),
                          (2, "The Resistance", 4321, "2 Dantooine Way."),
                          (3, "Cloud City", 5678, "In the Air over Bespin");
                          
insert into Payload VALUES(1, 1, b'101', 15700.47, '01', 1000, "Your nearest Imperial outpost order #72207"),
                          (2, 1, b'101', 22600.77, '10', 3570, "Your nearest Imperial outpost order #49852"),
                          (3, 2, b'101', 8070.47, '11', 1200, "Contact the Imperial Rebels on Dantooine"),
                          (4, 2, b'101', 60.77, '00', 10, "Help me obiwan kenobi, you're our only hope"),
                          (5, 3, b'101', 62700.47, '01', 4000, "Cloud City mining supplies"),
                          (6, 3, b'101', 77700.77, '10', 3570, "Guns just in case the toaster comes back");

insert into PolicyRequirements VALUES(1, 300, 'NA', false, '2017-12-04', '2018-01-05'),
                                     (3, 600, 'AB', true, '2017-12-03', '2018-02-04'),
				     (5, 900, 'BC', true, '2017-12-02', '2017-12-30');

insert into Workorder VALUES(1, 1, 1, "Endor", "Mandalore", "2017-12-04", "2018-01-05", false, 400),
                            (2, 3, 2, "Dantooine", "Tatooine", "2017-12-03", "2018-02-00", false, 4000),
			    (3, 5, 3, "Naboo", "Cloud City", "2017-12-02", "2017-12-30", false, 1000);




-- Driver
insert into User VALUES(4,'bounty','hunter',"I miss my dad too", 2),
                       (5,'sly','talker',"My ship is bigger than yours", 2);

insert into Contractor VALUES(1),(2);

insert into Driver VALUES(4, "Boba Fett", 12121212, 1111111111, 1357924, 1),
                         (5, "Han Solo", 34343434, 2222222222, 2468102, 2);

insert into Truck VALUES(1234567890, 1, "Mandalore", "9999", "B0UNTY", "Firespray", "31", "99", "AB", "01"),
                        (0987654321, 2, "Corellian", "4444", "SMU66L3R", "YT-1300F", "492727ZED", "00", "AB", "10");

