USE `restaurantManagementSoftware`;

-- ---------------------------------------------------------------------------
-- Insert table supplier
-- ---------------------------------------------------------------------------
INSERT INTO `supplier` (`id_supplier`, `name`, `contact_name`, `phone_number`, `fax_number`) VALUES
(1, 'Supplier A', 'David Fortin', '450-450-4500', '450-450-4000'),
(2, 'Supplier B', 'Alexandre Dubé', '450-450-4501', '450-450-4001'),
(3, 'Supplier C', 'Paul Germound', '1-450-450-4502', '1-450-450-4002'),
(4, 'Supplier D', 'Doris Laprade', '450-450-4503', '450-450-4003'),
(5, 'Supplier E', 'Henry Tibault', '1-450-450-4504', '1-450-450-4004');


-- ---------------------------------------------------------------------------
-- Insert table users
-- ---------------------------------------------------------------------------
INSERT INTO `users` (`id_user`, `username`, `name`, `email`, `password`, `salt`) VALUES
(1, 'aassaly', 'Andrew Assaly', 'aassaly@gmail.com', '6e6591627c7da94b0b3f31ff57589f82ec535352e0b66db038aa055495eb11edc7649560692b82267dda6eca1977a2f2336266550e9f9b55cfa5cf2e8f37972e', '1059368288c58a44f974d25c81cbf6cf607e15087f8aa0339ad13b635906259b5a31d5f4dd9896a91dd2545d62506a8f9494731dbdf29f803aba345a1b7496ba'),
(2, 'dfortin', 'David Fortin', 'davidfortin8640@gmail.com', '1a40afcd508909a06959536f3e7b1ebc89dce270ba6609ca39699e6eb41fad1aa85761444ac707d5cbf7b34821f70535635cf6e6e6184b6009bb3d880509a509', 'b1901714256032b06f8bfa1ba90c93bdaf138d8f0de3dbaf8e6306c7c1f1bdfc07eea690d02199ce6ef3cdf155ca22f171bc0a6226f0abc25d4a5e93fa21c563'),
(3, 'ohijazi', 'Omar Hijazi', 'ohijazi22@gmail.com', '8f4eca587bfdd8b00300d206ba82961c3c8a8cfe69a66b57449f20fff0a2f8fb4487314a09cd352b1d12ef364798d22625c086f19e1b4ee25403121cd010cff2', '1b8db8b9fb8f1c48dd5e5eca4f75427dee7d3b5b0e9620f8150a8f288117de30c7305992979374a458950289a2b47e31d5ca1475ac432e5eae34d69a7f49091d'),
(4, 'dfachin', 'Daniel Fachin', 'danfachin@gmail.com', 'ba37007093ba6838f62eaacf4b011b7a92f2c42585d2c00b462b54978507c24835f97307f95193c889dff6d39a33477602162c5af6461c5c432a140760895f3d', '533c8e8489b4028836e00f5ecdfb6aa18a11f42e29121f3d862377fd53d2df16c4f93d06d2ed08feb4290aa91f02d5b4fd1e62e4f7dec7da4de3cd1c09b52ff2');