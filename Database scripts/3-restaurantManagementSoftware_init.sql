USE `restaurantManagementSoftware`;

-- ---------------------------------------------------------------------------
-- Insert table supplier
-- ---------------------------------------------------------------------------
INSERT INTO `supplier` (`id_supplier`, `contact_name`, `phone_number`, `fax_number`) VALUES
(1, 'David Fortin', 4504504500, 4504504000),
(2, 'Alexandre Dubé', 4504504501, 4504504001),
(3, 'Paul Germound', 4504504502, 4504504002),
(4, 'Doris Laprade', 4504504503, 4504504003),
(5, 'Henry Tibault', 4504504504, 4504504004);


-- ---------------------------------------------------------------------------
-- Insert table users
-- ---------------------------------------------------------------------------
INSERT INTO `users` (`id_user`, `username`, `name`, `email`, `password`, `salt`) VALUES
(1, 'aassaly', 'Andrew Assaly', 'aassaly@gmail.com', '2bc22d634c16a74c94bd354a3066d3881019af483f3a28889f9b4aab8e5cdffb5d496c5a1eb6f2fa2b7499075b217ab04e1a69819efe4dd8504f024a851268c0', '1059368288c58a44f974d25c81cbf6cf607e15087f8aa0339ad13b635906259b5a31d5f4dd9896a91dd2545d62506a8f9494731dbdf29f803aba345a1b7496ba'),
(2, 'dfortin', 'David Fortin', 'davidfortin8640@gmail.com', '7e58e41c69749bccd276cb68cc4759ee63f08cc9393857cac9a341360615e5817de4c0cb6b74be058771969719fe28af25444a931d3a24d11732b75cadf97f89', 'b1901714256032b06f8bfa1ba90c93bdaf138d8f0de3dbaf8e6306c7c1f1bdfc07eea690d02199ce6ef3cdf155ca22f171bc0a6226f0abc25d4a5e93fa21c563'),
(3, 'ohijazi', 'Omar Hijazi', 'ohijazi22@gmail.com', 'b77e3d63f687bdcb9289630f71c9198a56ce11d09d3cadd54732436fa5790e79ac372add37624b6bc02ada6d01eeec535f40a0ecb1e4b28589d6b1f9742e3114', '1b8db8b9fb8f1c48dd5e5eca4f75427dee7d3b5b0e9620f8150a8f288117de30c7305992979374a458950289a2b47e31d5ca1475ac432e5eae34d69a7f49091d'),
(4, 'dfachin', 'Daniel Fachin', 'danfachin@gmail.com', '2accb0465c59484099c2e49a507e02a8d6e0a9abfc665abce559571a015e28efdbbdb901b6c8dfa6de37367d44b34a84dcadcbc88bef2079b73ba6f922e440c3', '533c8e8489b4028836e00f5ecdfb6aa18a11f42e29121f3d862377fd53d2df16c4f93d06d2ed08feb4290aa91f02d5b4fd1e62e4f7dec7da4de3cd1c09b52ff2');