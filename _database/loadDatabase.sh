sqlite3 auctionbase_data < drop.sql;
sqlite3 auctionbase_data < constraints_create.sql;
sqlite3 auctionbase_data < load.sql;
sh loadTriggers.sh
sqlite3 auctionbase_data < constraints_verify.sql;

