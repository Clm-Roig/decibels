DROP TABLE IF EXISTS composed_by;
DROP TABLE IF EXISTS plays_at;
DROP TABLE IF EXISTS plays_with;
DROP TABLE IF EXISTS news_refers_to;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS bands;
DROP TABLE IF EXISTS bands_temp;
DROP TABLE IF EXISTS forms;
DROP TABLE IF EXISTS gigs;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS news;
DROP TABLE IF EXISTS productions;
DROP TABLE IF EXISTS prod_types;
DROP TABLE IF EXISTS songs;
DROP TABLE IF EXISTS styles;

CREATE TABLE styles
(
    style_id INTEGER PRIMARY KEY NOT NULL,
    style_name TEXT
);

CREATE TABLE prod_types
(
    prod_type_id INTEGER PRIMARY KEY NOT NULL,
    prod_type_name TEXT
);

CREATE TABLE productions
(
    production_id INTEGER PRIMARY KEY NOT NULL,
    production_name TEXT,
    production_date DATE,
    production_style_id INTEGER,
    production_prod_type_id INTEGER,
    CONSTRAINT productions_styles_style_id_fk FOREIGN KEY (production_style_id) REFERENCES styles (style_id),
    CONSTRAINT productions_prod_types_prod_type_id_fk FOREIGN KEY (production_prod_type_id) REFERENCES prod_types (prod_type_id)
);

CREATE TABLE songs
(
    song_id INTEGER PRIMARY KEY NOT NULL,
    song_name TEXT NOT NULL,
    song_track_number INTEGER NOT NULL,
    song_length INTEGER
);


CREATE TABLE admins
(
    admin_id INTEGER PRIMARY KEY NOT NULL,
    admin_username TEXT NOT NULL,
    admin_password TEXT NOT NULL
);
CREATE TABLE bands
(
    band_id INTEGER PRIMARY KEY NOT NULL,
    band_name TEXT,
    band_formed_in INTEGER,
    band_style_id INTEGER,
    CONSTRAINT bands_styles_style_id_fk FOREIGN KEY (band_style_id) REFERENCES styles (style_id)
);
CREATE TABLE bands_temp
(
    band_id INTEGER PRIMARY KEY NOT NULL,
    band_name TEXT,
    band_formed_in INTEGER,
    band_style_name TEXT
);
CREATE TABLE composed_by
(
    composed_by_band_id INTEGER NOT NULL,
    composed_by_production_id INTEGER NOT NULL,
    CONSTRAINT composed_by_pkey PRIMARY KEY (composed_by_production_id, composed_by_band_id),
    CONSTRAINT composed_by_bands_band_id_fk FOREIGN KEY (composed_by_band_id) REFERENCES bands (band_id),
    CONSTRAINT composed_by_productions_production_id_fk FOREIGN KEY (composed_by_production_id) REFERENCES productions (production_id)
);
CREATE TABLE forms
(
    forms_song_id INTEGER NOT NULL,
    forms_production_id INTEGER NOT NULL,
    CONSTRAINT forms_forms_productions_id_forms_song_id_pk PRIMARY KEY (forms_production_id, forms_song_id),
    CONSTRAINT forms_songs_song_id_fk FOREIGN KEY (forms_song_id) REFERENCES songs (song_id),
    CONSTRAINT forms_productions_production_id_fk FOREIGN KEY (forms_production_id) REFERENCES productions (production_id)
);
CREATE TABLE gigs
(
    gig_id INTEGER PRIMARY KEY NOT NULL,
    gig_price NUMERIC(6,2),
    gig_place TEXT,
    gig_date DATE,
    gig_style_id INTEGER,
    gig_title TEXT,
    CONSTRAINT gigs_styles_style_id_fk FOREIGN KEY (gig_style_id) REFERENCES styles (style_id)
);
CREATE TABLE members
(
    member_id INTEGER PRIMARY KEY NOT NULL,
    member_first_name TEXT,
    member_last_name TEXT,
    member_pseudo TEXT
);
CREATE TABLE news
(
    news_id INTEGER PRIMARY KEY NOT NULL,
    news_date DATE,
    news_title TEXT,
    news_text TEXT
);
CREATE TABLE news_refers_to
(
    news_refers_to_band_id INTEGER NOT NULL,
    news_refers_to_news_id INTEGER NOT NULL,
    CONSTRAINT news_refers_to_news_refers_to_band_id_pk PRIMARY KEY (news_refers_to_band_id, news_refers_to_news_id),
    CONSTRAINT news_refers_to_bands_band_id_fk FOREIGN KEY (news_refers_to_band_id) REFERENCES bands (band_id),
    CONSTRAINT news_refers_to_news_news_id_fk FOREIGN KEY (news_refers_to_news_id) REFERENCES news (news_id)
);
CREATE TABLE plays_at
(
    plays_at_band_id INTEGER NOT NULL,
    plays_at_gig_id INTEGER NOT NULL,
    CONSTRAINT plays_at_pkey PRIMARY KEY (plays_at_gig_id, plays_at_band_id),
    CONSTRAINT plays_at_bands_band_id_fk FOREIGN KEY (plays_at_band_id) REFERENCES bands (band_id),
    CONSTRAINT plays_at_gigs_gig_id_fk FOREIGN KEY (plays_at_gig_id) REFERENCES gigs (gig_id)
);
CREATE TABLE plays_with
(
    plays_with_member_id INTEGER NOT NULL,
    plays_with_band_id INTEGER NOT NULL,
    plays_with_instrument TEXT,
    CONSTRAINT plays_with_plays_with_band_id_plays_with_member_id_pk PRIMARY KEY (plays_with_band_id, plays_with_member_id),
    CONSTRAINT plays_with_members_member_id_fk FOREIGN KEY (plays_with_member_id) REFERENCES members (member_id),
    CONSTRAINT plays_with_bands_band_id_fk FOREIGN KEY (plays_with_band_id) REFERENCES bands (band_id)
);
