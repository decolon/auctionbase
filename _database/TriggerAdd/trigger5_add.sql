--Checks to make sure when you update User the user has a non null location and country in if the User is a seller (in the Auction Table)
PRAGMA foreign_keys = ON;
drop trigger if exists updateUserLocation;
create trigger updateUserLocation
after update on User
when (new.UserID in(select UserID from Auction) and (new.Location is null or new.Country is null))
begin
	select raise(rollback, "Auction.UserID must have non null location and country");
end;

