--
-- PostgreSQL database dump
--

\restrict YyjIywJR30XENUrMghoUTmPIEPY0MXANZxo6XjEeytCNbMAqf5auwdQQD3ZEfJa

-- Dumped from database version 17.6 (Debian 17.6-1.pgdg13+1)
-- Dumped by pg_dump version 17.6 (Debian 17.6-1.pgdg13+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: difficulty_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.difficulty_enum AS ENUM (
    'easy',
    'normal',
    'hard'
);


ALTER TYPE public.difficulty_enum OWNER TO postgres;

--
-- Name: drifs_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.drifs_enum AS ENUM (
    'amad',
    'ann',
    'eras',
    'err',
    'lun',
    'verd',
    'von',
    'elen',
    'grod',
    'grud',
    'tall',
    'tovi',
    'alorn',
    'faln',
    'farid',
    'holm',
    'iori',
    'jorn',
    'abaf',
    'astah',
    'band',
    'kalh',
    'teld',
    'unn',
    'val',
    'dur',
    'ling',
    'lorb',
    'oda',
    'ulk'
);


ALTER TYPE public.drifs_enum OWNER TO postgres;

--
-- Name: profession_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.profession_enum AS ENUM (
    'mag ognia',
    'voodoo',
    'druid',
    'sheed',
    'łucznik',
    'rycerz',
    'barbarzyńca'
);


ALTER TYPE public.profession_enum OWNER TO postgres;

--
-- Name: server_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.server_enum AS ENUM (
    'Thanar',
    'Veskara',
    'Vardis'
);


ALTER TYPE public.server_enum OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: boss_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.boss_items (
    boss_id integer NOT NULL,
    item_id integer NOT NULL
);


ALTER TABLE public.boss_items OWNER TO postgres;

--
-- Name: bosses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bosses (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    tier integer DEFAULT 3 NOT NULL,
    min_syng integer DEFAULT 2 NOT NULL,
    max_syng integer DEFAULT 2 NOT NULL,
    CONSTRAINT bosses_tier_check CHECK (((tier >= 1) AND (tier <= 4)))
);


ALTER TABLE public.bosses OWNER TO postgres;

--
-- Name: bosses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bosses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.bosses_id_seq OWNER TO postgres;

--
-- Name: bosses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bosses_id_seq OWNED BY public.bosses.id;


--
-- Name: characters; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.characters (
    id integer NOT NULL,
    user_id integer NOT NULL,
    name character varying(50) NOT NULL,
    level integer NOT NULL,
    profession character varying NOT NULL,
    server character varying NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT characters_level_check CHECK (((level >= 1) AND (level <= 140)))
);


ALTER TABLE public.characters OWNER TO postgres;

--
-- Name: characters_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.characters_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.characters_id_seq OWNER TO postgres;

--
-- Name: characters_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.characters_id_seq OWNED BY public.characters.id;


--
-- Name: drifs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.drifs (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.drifs OWNER TO postgres;

--
-- Name: drifs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.drifs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.drifs_id_seq OWNER TO postgres;

--
-- Name: drifs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.drifs_id_seq OWNED BY public.drifs.id;


--
-- Name: items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.items (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.items OWNER TO postgres;

--
-- Name: items_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.items_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.items_id_seq OWNER TO postgres;

--
-- Name: items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.items_id_seq OWNED BY public.items.id;


--
-- Name: rars; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rars (
    id integer NOT NULL,
    boss_id integer NOT NULL,
    name character varying(100) NOT NULL,
    tier integer NOT NULL,
    CONSTRAINT rars_tier_check CHECK (((tier >= 1) AND (tier <= 4)))
);


ALTER TABLE public.rars OWNER TO postgres;

--
-- Name: rars_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rars_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rars_id_seq OWNER TO postgres;

--
-- Name: rars_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rars_id_seq OWNED BY public.rars.id;


--
-- Name: record_drifs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.record_drifs (
    record_id integer NOT NULL,
    drif_id integer NOT NULL,
    tier integer NOT NULL,
    CONSTRAINT record_drifs_tier_check CHECK (((tier >= 1) AND (tier <= 4)))
);


ALTER TABLE public.record_drifs OWNER TO postgres;

--
-- Name: record_gold; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.record_gold (
    record_id integer NOT NULL,
    amount integer NOT NULL,
    CONSTRAINT record_gold_amount_check CHECK ((amount >= 0))
);


ALTER TABLE public.record_gold OWNER TO postgres;

--
-- Name: record_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.record_items (
    record_id integer NOT NULL,
    item_id integer NOT NULL,
    amount integer NOT NULL,
    CONSTRAINT record_items_amount_check CHECK ((amount > 0))
);


ALTER TABLE public.record_items OWNER TO postgres;

--
-- Name: record_rars; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.record_rars (
    record_id integer NOT NULL,
    rar_id integer NOT NULL,
    quality integer NOT NULL,
    CONSTRAINT record_rars_quality_check CHECK (((quality >= 1) AND (quality <= 9)))
);


ALTER TABLE public.record_rars OWNER TO postgres;

--
-- Name: record_synergetics; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.record_synergetics (
    record_id integer NOT NULL,
    tier integer NOT NULL,
    CONSTRAINT record_synergetics_tier_check CHECK (((tier >= 2) AND (tier <= 14)))
);


ALTER TABLE public.record_synergetics OWNER TO postgres;

--
-- Name: record_trops; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.record_trops (
    record_id integer NOT NULL,
    tier integer NOT NULL,
    amount integer NOT NULL,
    CONSTRAINT record_trops_amount_check CHECK ((amount > 0)),
    CONSTRAINT record_trops_tier_check CHECK (((tier >= 1) AND (tier <= 4)))
);


ALTER TABLE public.record_trops OWNER TO postgres;

--
-- Name: records; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.records (
    id integer NOT NULL,
    character_id integer NOT NULL,
    boss_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    difficulty character varying(50) DEFAULT 'normal'::character varying NOT NULL
);


ALTER TABLE public.records OWNER TO postgres;

--
-- Name: records_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.records_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.records_id_seq OWNER TO postgres;

--
-- Name: records_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.records_id_seq OWNED BY public.records.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(100) NOT NULL,
    password_hash character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: bosses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bosses ALTER COLUMN id SET DEFAULT nextval('public.bosses_id_seq'::regclass);


--
-- Name: characters id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.characters ALTER COLUMN id SET DEFAULT nextval('public.characters_id_seq'::regclass);


--
-- Name: drifs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.drifs ALTER COLUMN id SET DEFAULT nextval('public.drifs_id_seq'::regclass);


--
-- Name: items id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.items ALTER COLUMN id SET DEFAULT nextval('public.items_id_seq'::regclass);


--
-- Name: rars id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rars ALTER COLUMN id SET DEFAULT nextval('public.rars_id_seq'::regclass);


--
-- Name: records id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.records ALTER COLUMN id SET DEFAULT nextval('public.records_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: boss_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.boss_items (boss_id, item_id) FROM stdin;
1	1
2	1
4	1
1	2
3	2
4	2
2	3
3	3
4	3
\.


--
-- Data for Name: bosses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bosses (id, name, tier, min_syng, max_syng) FROM stdin;
2	Jaskółka	3	3	8
4	Admirał Utoru	4	8	11
3	Konstrukt	3	3	8
1	Ivravul	3	2	5
\.


--
-- Data for Name: characters; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.characters (id, user_id, name, level, profession, server, created_at) FROM stdin;
14	2	ProRycKox	140	Rycerz	Thanar	2025-09-06 21:10:49.979766
15	2	Grzesiooo	123	Rycerz	Vardis	2025-09-06 21:12:14.051777
16	2	xxxprodrxxx	140	Druid	Thanar	2025-09-07 20:35:23.32097
17	3	asd	123	Druid	Thanar	2025-09-07 21:01:42.080917
\.


--
-- Data for Name: drifs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.drifs (id, name) FROM stdin;
1	amad
2	ann
3	eras
4	err
5	lun
6	verd
7	von
8	elen
9	grod
10	grud
11	tall
12	tovi
13	alorn
14	faln
15	farid
16	holm
17	iori
18	jorn
19	abaf
20	astah
21	band
22	kalh
23	teld
24	unn
25	val
26	dur
27	ling
28	lorb
29	oda
30	ulk
\.


--
-- Data for Name: items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.items (id, name) FROM stdin;
1	Glif Bakalarski
2	Dielektryk
3	Esencja
\.


--
-- Data for Name: rars; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rars (id, boss_id, name, tier) FROM stdin;
1	1	Nadzieja Pokoleń	3
2	1	Powrót Ivravula	3
4	1	Władca losu	3
5	1	Zemsta Ivravula	3
6	2	Fanga	3
7	2	Griv	3
8	2	Vogurun	3
9	2	Yurugu	3
10	2	Zadry	3
11	3	Harttraum	3
12	3	Otwieracz	3
13	3	Sigil	3
14	4	Admiralski Gronostaj	4
15	4	Inavoxy	4
16	4	Kil	4
17	4	Szpony Seimhi	4
18	4	Takerony	4
19	4	Trójząb admiralski	4
\.


--
-- Data for Name: record_drifs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.record_drifs (record_id, drif_id, tier) FROM stdin;
9	1	1
12	15	1
13	8	1
14	12	3
\.


--
-- Data for Name: record_gold; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.record_gold (record_id, amount) FROM stdin;
9	50000
10	100
11	50000
12	50000
13	50000
14	17777
15	15000
\.


--
-- Data for Name: record_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.record_items (record_id, item_id, amount) FROM stdin;
9	1	1
9	2	1
11	1	2
11	2	2
12	1	2
12	2	2
13	1	5
13	2	5
14	1	1
14	2	1
15	1	4
15	2	4
\.


--
-- Data for Name: record_rars; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.record_rars (record_id, rar_id, quality) FROM stdin;
9	1	1
11	2	1
14	5	9
15	1	1
\.


--
-- Data for Name: record_synergetics; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.record_synergetics (record_id, tier) FROM stdin;
9	2
12	2
13	5
14	2
\.


--
-- Data for Name: record_trops; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.record_trops (record_id, tier, amount) FROM stdin;
9	1	1
11	1	2
12	1	2
13	1	2
14	1	1
15	1	5
\.


--
-- Data for Name: records; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.records (id, character_id, boss_id, created_at, difficulty) FROM stdin;
9	14	1	2025-09-10 21:57:40.756019	Hard
10	14	4	2025-09-10 22:50:01.22968	Hard
11	14	1	2025-09-11 01:50:29.109994	Hard
12	14	1	2025-09-11 01:50:36.764574	Hard
13	14	1	2025-09-11 01:50:52.781878	Hard
14	14	1	2025-09-11 12:19:15.791987	Normal
15	14	1	2025-09-11 14:12:16.34569	Hard
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, email, password_hash, created_at) FROM stdin;
2	piotr@gmail.com	$2y$10$wGKk9Ae57QpFk57aZS0.IelmtA/lWQZR34vWsKoxyB1/Ca5P0MdlC	2025-09-05 18:13:13.64953
3	wika@gmail.com	$2y$10$BD2J/u3QElxatggVmZMOlOCicSpLNVCy207uqe6t0N3axQqP2tNFy	2025-09-05 18:37:12.729638
4	mati@gmail.com	$2y$10$YQaoWk7RPqrvYDYjIPuL7eVB0LxjFEfof8i1t5g3mqmTF8VJTNcKm	2025-09-05 21:17:40.226417
5	wujek@gmail.com	$2y$10$3CJ29jl3g3XoFb1zFO6xWOG88eLBVuHEByqUNh2tkwrqy/HEmxqka	2025-09-05 21:42:16.034917
6	cc@gmail.com	$2y$10$i5AzYrEFsQPLsNs93GCHdur3P1wFhLOCpzOkOQPAEbmXzalUjvh9C	2025-09-05 21:48:44.813834
7	dupa@gmail.com	$2y$10$zm2lpU7agqaAxgDwYHdxUuWF08iDePrNPtoTWKe7UF3g83dU4aX3C	2025-09-05 22:18:13.990208
8	aa@gmail.com	$2y$10$DOWRFLjDsZfoVIBBcG9WguSAa2G7gL8RkO4X1cbrPBTri7sgoCdMu	2025-09-05 22:34:12.757642
9	rcrc@gmail.com	$2y$10$0Kym6cMitL3UcEH8Pl1P8e5Wbgm22ZzW5EvuL5OuL/Qrbar3YLCJ2	2025-09-05 23:27:55.373438
10	amen@gmail.com	$2y$10$r.414YRhxBziBrOnZ6s5le3c9PTg4LNpiqqyxDuSXHhRhAH/Lizai	2025-09-05 23:39:18.075885
11	dupa@dupa.pl	$2y$10$V2XZuxsHJLbttbXuQtvVFeJ/z.yTzck2Mt.vqRL9nIKhLI.UGlGqq	2025-09-05 23:39:29.150375
12	chuj@chuj.chuj	$2y$10$ac0rSTPhZkmvTs.nduBs7OPBTBPVn85wwOiVbfE4oEy1X1j1lr2MK	2025-09-06 00:11:05.681622
13	debil@gmail.com	$2y$10$6M0LmI6ThYs54ZSZY/YsFelgnR0cRR85i/ELidvGwPfUXkFxJd6Yq	2025-09-06 00:29:34.646043
\.


--
-- Name: bosses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bosses_id_seq', 4, true);


--
-- Name: characters_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.characters_id_seq', 17, true);


--
-- Name: drifs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.drifs_id_seq', 30, true);


--
-- Name: items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.items_id_seq', 3, true);


--
-- Name: rars_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rars_id_seq', 19, true);


--
-- Name: records_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.records_id_seq', 15, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 13, true);


--
-- Name: boss_items boss_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boss_items
    ADD CONSTRAINT boss_items_pkey PRIMARY KEY (boss_id, item_id);


--
-- Name: bosses bosses_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bosses
    ADD CONSTRAINT bosses_name_key UNIQUE (name);


--
-- Name: bosses bosses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bosses
    ADD CONSTRAINT bosses_pkey PRIMARY KEY (id);


--
-- Name: characters characters_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.characters
    ADD CONSTRAINT characters_pkey PRIMARY KEY (id);


--
-- Name: drifs drifs_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.drifs
    ADD CONSTRAINT drifs_name_key UNIQUE (name);


--
-- Name: drifs drifs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.drifs
    ADD CONSTRAINT drifs_pkey PRIMARY KEY (id);


--
-- Name: items items_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.items
    ADD CONSTRAINT items_name_key UNIQUE (name);


--
-- Name: items items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.items
    ADD CONSTRAINT items_pkey PRIMARY KEY (id);


--
-- Name: rars rars_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rars
    ADD CONSTRAINT rars_pkey PRIMARY KEY (id);


--
-- Name: record_drifs record_drifs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_drifs
    ADD CONSTRAINT record_drifs_pkey PRIMARY KEY (record_id, drif_id);


--
-- Name: record_gold record_gold_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_gold
    ADD CONSTRAINT record_gold_pkey PRIMARY KEY (record_id);


--
-- Name: record_items record_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_items
    ADD CONSTRAINT record_items_pkey PRIMARY KEY (record_id, item_id);


--
-- Name: record_rars record_rars_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_rars
    ADD CONSTRAINT record_rars_pkey PRIMARY KEY (record_id, rar_id);


--
-- Name: record_synergetics record_synergetics_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_synergetics
    ADD CONSTRAINT record_synergetics_pkey PRIMARY KEY (record_id, tier);


--
-- Name: record_trops record_trops_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_trops
    ADD CONSTRAINT record_trops_pkey PRIMARY KEY (record_id, tier);


--
-- Name: records records_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.records
    ADD CONSTRAINT records_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: boss_items boss_items_boss_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boss_items
    ADD CONSTRAINT boss_items_boss_id_fkey FOREIGN KEY (boss_id) REFERENCES public.bosses(id) ON DELETE CASCADE;


--
-- Name: boss_items boss_items_item_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boss_items
    ADD CONSTRAINT boss_items_item_id_fkey FOREIGN KEY (item_id) REFERENCES public.items(id) ON DELETE CASCADE;


--
-- Name: characters characters_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.characters
    ADD CONSTRAINT characters_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: rars rars_boss_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rars
    ADD CONSTRAINT rars_boss_id_fkey FOREIGN KEY (boss_id) REFERENCES public.bosses(id) ON DELETE CASCADE;


--
-- Name: record_drifs record_drifs_drif_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_drifs
    ADD CONSTRAINT record_drifs_drif_id_fkey FOREIGN KEY (drif_id) REFERENCES public.drifs(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: record_drifs record_drifs_record_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_drifs
    ADD CONSTRAINT record_drifs_record_id_fkey FOREIGN KEY (record_id) REFERENCES public.records(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: record_gold record_gold_record_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_gold
    ADD CONSTRAINT record_gold_record_id_fkey FOREIGN KEY (record_id) REFERENCES public.records(id) ON DELETE CASCADE;


--
-- Name: record_items record_items_item_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_items
    ADD CONSTRAINT record_items_item_id_fkey FOREIGN KEY (item_id) REFERENCES public.items(id) ON DELETE CASCADE;


--
-- Name: record_items record_items_record_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_items
    ADD CONSTRAINT record_items_record_id_fkey FOREIGN KEY (record_id) REFERENCES public.records(id) ON DELETE CASCADE;


--
-- Name: record_rars record_rars_rar_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_rars
    ADD CONSTRAINT record_rars_rar_id_fkey FOREIGN KEY (rar_id) REFERENCES public.rars(id) ON DELETE CASCADE;


--
-- Name: record_rars record_rars_record_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_rars
    ADD CONSTRAINT record_rars_record_id_fkey FOREIGN KEY (record_id) REFERENCES public.records(id) ON DELETE CASCADE;


--
-- Name: record_synergetics record_synergetics_record_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_synergetics
    ADD CONSTRAINT record_synergetics_record_id_fkey FOREIGN KEY (record_id) REFERENCES public.records(id) ON DELETE CASCADE;


--
-- Name: record_trops record_trops_record_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.record_trops
    ADD CONSTRAINT record_trops_record_id_fkey FOREIGN KEY (record_id) REFERENCES public.records(id) ON DELETE CASCADE;


--
-- Name: records records_boss_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.records
    ADD CONSTRAINT records_boss_id_fkey FOREIGN KEY (boss_id) REFERENCES public.bosses(id) ON DELETE CASCADE;


--
-- Name: records records_character_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.records
    ADD CONSTRAINT records_character_id_fkey FOREIGN KEY (character_id) REFERENCES public.characters(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict YyjIywJR30XENUrMghoUTmPIEPY0MXANZxo6XjEeytCNbMAqf5auwdQQD3ZEfJa

