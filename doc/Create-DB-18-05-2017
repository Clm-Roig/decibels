create table bands
(
	band_id serial not null
		constraint band_pkey
			primary key,
	band_name text,
	band_formed_in integer,
	band_style_id integer
)
;

create table members
(
	member_id serial not null
		constraint members_pkey
			primary key,
	member_first_name text,
	member_last_name text,
	member_pseudo text
)
;

create table styles
(
	style_id serial not null
		constraint styles_pkey
			primary key,
	style_name text
)
;

create table gigs
(
	gig_id serial not null
		constraint gigs_pkey
			primary key,
	gig_price numeric(6,2),
	gig_place text,
	gig_style_id integer
)
;

create table news
(
	news_id serial not null
		constraint news_pkey
			primary key,
	news_date date,
	news_title text,
	news_text text
)
;

create table productions
(
	production_id serial not null
		constraint productions_pkey
			primary key,
	production_name text,
	production_date date,
	production_style_id integer,
	production_prod_type_id integer
)
;

create table prod_types
(
	prod_type_id serial not null
		constraint prod_types_pkey
			primary key,
	prod_type_name text
)
;

create table songs
(
	song_id serial not null
		constraint songs_song_id_pk
			primary key,
	song_name text not null,
	song_track_number integer not null,
	song_length integer
)
;

create unique index songs_song_id_uindex
	on songs (song_id)
;

create table plays_at
(
	plays_at_band_id integer not null,
	plays_at_gig_id integer not null,
	constraint plays_at_pkey
		primary key (plays_at_gig_id, plays_at_band_id)
)
;

create table news_refers_to
(
	news_refers_to_band_id integer not null,
	news_refers_to_news_id integer not null,
	constraint news_refers_to_news_refers_to_band_id_pk
		primary key (news_refers_to_band_id, news_refers_to_news_id)
)
;

create table forms
(
	forms_song_id integer not null,
	forms_productions_id integer not null,
	constraint forms_forms_productions_id_forms_song_id_pk
		primary key (forms_productions_id, forms_song_id)
)
;

create table plays_with
(
	plays_with_member_id integer not null,
	plays_with_band_id integer not null,
	plays_with_instrument text,
	constraint plays_with_plays_with_band_id_plays_with_member_id_pk
		primary key (plays_with_band_id, plays_with_member_id)
)
;

create table composed_by
(
	composed_by_band_id integer not null,
	composed_by_production_id integer not null
		constraint composed_by_pkey
			primary key
)
;


