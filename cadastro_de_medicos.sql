--
-- PostgreSQL database dump
--

\restrict dttkm8fIDIIhqJaLjMU77JCtcOWTPGrpxu6kSFTKfy6nBKwH9nUdY9xMawopbsn

-- Dumped from database version 16.15 (Ubuntu 16.15-0ubuntu0.24.04.1)
-- Dumped by pg_dump version 16.15 (Ubuntu 16.15-0ubuntu0.24.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: auditoria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoria (
    id integer NOT NULL,
    acao text,
    id_medico integer,
    data_acao timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    dados_antes jsonb,
    dados_depois jsonb
);


ALTER TABLE public.auditoria OWNER TO postgres;

--
-- Name: auditoria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoria_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoria_id_seq OWNER TO postgres;

--
-- Name: auditoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoria_id_seq OWNED BY public.auditoria.id;


--
-- Name: medicos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.medicos (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    crm character varying(100) NOT NULL,
    especialidade character varying(100) NOT NULL,
    telefone character varying(100),
    email character varying(100),
    situacao boolean DEFAULT true NOT NULL,
    data_cadastro timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.medicos OWNER TO postgres;

--
-- Name: medicos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.medicos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.medicos_id_seq OWNER TO postgres;

--
-- Name: medicos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.medicos_id_seq OWNED BY public.medicos.id;


--
-- Name: auditoria id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoria ALTER COLUMN id SET DEFAULT nextval('public.auditoria_id_seq'::regclass);


--
-- Name: medicos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicos ALTER COLUMN id SET DEFAULT nextval('public.medicos_id_seq'::regclass);


--
-- Data for Name: auditoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoria (id, acao, id_medico, data_acao, dados_antes, dados_depois) FROM stdin;
1	create	3	2026-09-23 21:19:09.18325	\N	{"crm": "010101", "nome": "Francisca Lucicleuba", "email": "", "telefone": "01010101010", "especialidade": "Cirurgião"}
2	update	3	2026-09-23 21:19:30.974851	{"id": "3", "crm": "010101", "nome": "Francisca Lucicleuba", "email": "", "situacao": "t", "telefone": "01010101010", "data_cadastro": "2026-09-23 21:19:09.167152-03", "especialidade": "Cirurgião"}	{"crm": "010101", "nome": "Francisca Lucicleuba", "email": "", "situacao": false, "telefone": "01010101010", "especialidade": "Cirurgião"}
3	update	3	2026-09-23 21:19:52.299172	{"id": "3", "crm": "010101", "nome": "Francisca Lucicleuba", "email": "", "situacao": "f", "telefone": "01010101010", "data_cadastro": "2026-09-23 21:19:09.167152-03", "especialidade": "Cirurgião"}	{"crm": "010101", "nome": "Francisca Lucicleuba", "email": "", "situacao": false, "telefone": "01010101010", "especialidade": "Cirurgião"}
4	delete	3	2026-09-23 21:20:06.728265	{"id": "3", "crm": "010101", "nome": "Francisca Lucicleuba", "email": "", "situacao": "f", "telefone": "01010101010", "data_cadastro": "2026-09-23 21:19:09.167152-03", "especialidade": "Cirurgião"}	\N
\.


--
-- Data for Name: medicos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.medicos (id, nome, crm, especialidade, telefone, email, situacao, data_cadastro) FROM stdin;
1	Roger Rubens	123456	Ortopedista	85999999999	roger@gmail.com	t	2026-09-23 21:11:53.940812-03
2	João Silva	654321	Cardiologista	85988888888	joao@gmail.com	t	2026-09-23 21:11:53.940812-03
\.


--
-- Name: auditoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoria_id_seq', 4, true);


--
-- Name: medicos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.medicos_id_seq', 3, true);


--
-- Name: auditoria auditoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoria
    ADD CONSTRAINT auditoria_pkey PRIMARY KEY (id);


--
-- Name: medicos medicos_crm_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicos
    ADD CONSTRAINT medicos_crm_key UNIQUE (crm);


--
-- Name: medicos medicos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicos
    ADD CONSTRAINT medicos_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

\unrestrict dttkm8fIDIIhqJaLjMU77JCtcOWTPGrpxu6kSFTKfy6nBKwH9nUdY9xMawopbsn

