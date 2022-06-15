create table result (id int auto_increment primary key, date varchar(64), color varchar(6), timeRange varchar(6), result boolean, opening varchar(64), opponentName varchar(64), moves(1024));
create table annotation (gameid int primary key, moveNumber int primary key, message varchar(1024));
create table opponent (name varchar(128) primary key, overallResult varchar(32), misc varchar(512));

insert into result (date, color, timeRange, result, opening, opponentName, moves) values ("2022.05.02", "white", "10+0", true, "Slav Defense: Modern Line", "A", "d4 d5 c4 c6 Nf3 e6 Nc3 a6 Bg5 f6 Bh4 b5 cxd5 cxd5 e3 Bb4 Be2 Bxc3+ bxc3 Qa5 Qb3 Nd7 O-O Bb7 Bg3 Ne7 Nd2 Nf5 Bf4 O-O e4 Ne7 e5 fxe5 Bxe5 Nxe5 dxe5 Rf5 Nf3 Ng6 Bd3 Rh5 Bxg6 hxg6 Qc2 Kf7 Nd4 Rxe5 Nf3 Rf5 Nh4 Rh5 Qxg6+ Ke7 Qxh5 Qxc3 Qg5+ Kd6 Qg3+ Qxg3 fxg3 g5 Ng6 Rg8 Rf7 Rxg6 Rxb7 d4 Rb6+ Kc5 Rxa6 b4 a3 b3 Rb1 Kc4 Rb6 d3 R6xb3 e5 Kf2 e4 Ke1 Rd6 Kd2 Re6 a4 e3+ Kd1 e2+ Ke1 Kd4 Rb4+ Kc3 R4b3+ Kc2 R3b2+ Kc3 a5 Ra6 Rb3+ Kc2 R1b2+ Kc1 Ra2 d2+ Rxd2 Rxa5 Rxe2 Rd5 Rc3+ Kb1 Rd2 Re5+ Re2 Rd5 h4 gxh4 gxh4 Rf5 g4 Rf4 Rg2 Re4+ Kf2 Kb2 Re3 Rc4 h5 Rf4+ Rf3 Ra4 h6 Ra8 g5 Rh8 Rh2 Rg8 Rg3 Kc1 h7 Rf8+ Kg2 Ra8 h8=Q Rxh8 Rxh8 Kd2 g6 Ke2 g7 Ke1 g8=Q Ke2 Rh7 Ke1 Re7+ Kd2 Qd8+");

insert into result (date, color, timeRange, result, opening, opponentName, moves) values ("2022.06.03", "black",  "10+0", false, "Queen's Pawn Game: Mason Variation", "B", "d4 d5 Bf4 Nf6 e3 c5 Bb5+ Bd7 Bxd7+ Nbxd7 c3 Qb6 Qc2 e6 Nd2 Be7 Ngf3 h6 h3 c4 O-O O-O b3 Nh5 Rab1 Nxf4 exf4 Qc7 g3 Bd6 bxc4 dxc4 Qa4 Rfe8 Nxc4 f6 Nxd6 Qxd6 Rxb7 e5 Rxd7");

insert into opponent values ("A", "1-0", "dude");
insert into opponent values ("B", "0-1", "chick");

insert into annotation values (1, 11, "I should've moved the bishop to d2 to prevent the knight from being pinnded");
insert into annotation values (1, 25, "I should've played a4 because I could capture b pawn for free");
