sqlite3 AuctionBase < drop.sql;
sqlite3 AuctionBase < constraints_create.sql;
sqlite3 AuctionBase < load.sql;
sh loadTriggers.sh
sqlite3 AuctionBase < constraints_verify.sql;

