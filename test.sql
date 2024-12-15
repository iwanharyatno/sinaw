CREATE TABLE public.answers (
    id bigint NOT NULL,
    question_id bigint NOT NULL,
    content text NOT NULL,
    is_correct boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.answers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.answers_id_seq OWNED BY public.answers.id;
CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
CREATE TABLE public.forum_posts (
    id bigint NOT NULL,
    forum_id bigint NOT NULL,
    user_id bigint NOT NULL,
    content text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.forum_posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.forum_posts_id_seq OWNED BY public.forum_posts.id;
CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
CREATE TABLE public.kelas (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_by bigint NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE TABLE public.kelas_forums (
    id bigint NOT NULL,
    class_id bigint NOT NULL,
    title character varying(255) NOT NULL,
    created_by bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.kelas_forums_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.kelas_forums_id_seq OWNED BY public.kelas_forums.id;
CREATE SEQUENCE public.kelas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.kelas_id_seq OWNED BY public.kelas.id;
CREATE TABLE public.kelas_members (
    id bigint NOT NULL,
    class_id bigint NOT NULL,
    user_id bigint NOT NULL,
    role character varying(255) NOT NULL,
    joined_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT kelas_members_role_check CHECK (((role)::text = ANY ((ARRAY['student'::character varying, 'teacher'::character varying])::text[])))
);
CREATE SEQUENCE public.kelas_members_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.kelas_members_id_seq OWNED BY public.kelas_members.id;
CREATE TABLE public.media (
    id bigint NOT NULL,
    mediable_id integer NOT NULL,
    mediable_type character varying(255) NOT NULL,
    file_path character varying(255) NOT NULL,
    uploaded_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.media_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.media_id_seq OWNED BY public.media.id;
CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
CREATE TABLE public.questions (
    id bigint NOT NULL,
    quiz_id bigint NOT NULL,
    content text NOT NULL,
    question_type character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT questions_question_type_check CHECK (((question_type)::text = ANY ((ARRAY['MCQ'::character varying, 'Short Answer'::character varying])::text[])))
);
CREATE SEQUENCE public.questions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.questions_id_seq OWNED BY public.questions.id;
CREATE TABLE public.quiz_attempts (
    id bigint NOT NULL,
    quiz_id bigint NOT NULL,
    user_id bigint NOT NULL,
    score double precision NOT NULL,
    attempted_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.quiz_attempts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.quiz_attempts_id_seq OWNED BY public.quiz_attempts.id;
CREATE TABLE public.quizzes (
    id bigint NOT NULL,
    class_id bigint,
    quiz_name character varying(255) NOT NULL,
    description text NOT NULL,
    created_by bigint NOT NULL,
    is_public boolean DEFAULT true NOT NULL,
    difficulty character varying(255) NOT NULL,
    duration_min integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    header_path character varying(255),
    CONSTRAINT quizzes_difficulty_check CHECK (((difficulty)::text = ANY ((ARRAY['easy'::character varying, 'medium'::character varying, 'hard'::character varying])::text[])))
);
CREATE SEQUENCE public.quizzes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.quizzes_id_seq OWNED BY public.quizzes.id;
CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
CREATE TABLE public.study_materials (
    id bigint NOT NULL,
    class_id bigint NOT NULL,
    uploaded_by bigint NOT NULL,
    title character varying(255) NOT NULL,
    file_path character varying(255) NOT NULL,
    uploaded_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.study_materials_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.study_materials_id_seq OWNED BY public.study_materials.id;
CREATE TABLE public.thread_discussions (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    category character varying(255) DEFAULT 'Lainnya'::character varying NOT NULL,
    CONSTRAINT thread_discussions_category_check CHECK (((category)::text = ANY ((ARRAY['Matematika'::character varying, 'Sains'::character varying, 'Teknologi'::character varying, 'Komputer'::character varying, 'Filosofi'::character varying, 'Lainnya'::character varying])::text[])))
);
CREATE SEQUENCE public.thread_discussions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.thread_discussions_id_seq OWNED BY public.thread_discussions.id;
CREATE TABLE public.thread_replies (
    id bigint NOT NULL,
    thread_id bigint NOT NULL,
    user_id bigint NOT NULL,
    content text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.thread_replies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.thread_replies_id_seq OWNED BY public.thread_replies.id;
CREATE TABLE public.users (
    id bigint NOT NULL,
    first_name character varying(255) NOT NULL,
    last_name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    avatar character varying(255),
    points integer DEFAULT 0 NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

 
ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
ALTER TABLE ONLY public.answers ALTER COLUMN id SET DEFAULT nextval('public.answers_id_seq'::regclass);
ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
ALTER TABLE ONLY public.forum_posts ALTER COLUMN id SET DEFAULT nextval('public.forum_posts_id_seq'::regclass);
ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
ALTER TABLE ONLY public.kelas ALTER COLUMN id SET DEFAULT nextval('public.kelas_id_seq'::regclass);
ALTER TABLE ONLY public.kelas_forums ALTER COLUMN id SET DEFAULT nextval('public.kelas_forums_id_seq'::regclass);
ALTER TABLE ONLY public.kelas_members ALTER COLUMN id SET DEFAULT nextval('public.kelas_members_id_seq'::regclass);
ALTER TABLE ONLY public.media ALTER COLUMN id SET DEFAULT nextval('public.media_id_seq'::regclass);
ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
ALTER TABLE ONLY public.questions ALTER COLUMN id SET DEFAULT nextval('public.questions_id_seq'::regclass);
ALTER TABLE ONLY public.quiz_attempts ALTER COLUMN id SET DEFAULT nextval('public.quiz_attempts_id_seq'::regclass);
ALTER TABLE ONLY public.quizzes ALTER COLUMN id SET DEFAULT nextval('public.quizzes_id_seq'::regclass);
ALTER TABLE ONLY public.study_materials ALTER COLUMN id SET DEFAULT nextval('public.study_materials_id_seq'::regclass);
ALTER TABLE ONLY public.thread_discussions ALTER COLUMN id SET DEFAULT nextval('public.thread_discussions_id_seq'::regclass);
ALTER TABLE ONLY public.thread_replies ALTER COLUMN id SET DEFAULT nextval('public.thread_replies_id_seq'::regclass);
ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
ALTER TABLE ONLY public.answers
    ADD CONSTRAINT answers_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
ALTER TABLE ONLY public.forum_posts
    ADD CONSTRAINT forum_posts_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.kelas_forums
    ADD CONSTRAINT kelas_forums_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.kelas_members
    ADD CONSTRAINT kelas_members_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
ALTER TABLE ONLY public.questions
    ADD CONSTRAINT questions_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.quiz_attempts
    ADD CONSTRAINT quiz_attempts_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.quizzes
    ADD CONSTRAINT quizzes_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.study_materials
    ADD CONSTRAINT study_materials_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.thread_discussions
    ADD CONSTRAINT thread_discussions_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.thread_replies
    ADD CONSTRAINT thread_replies_pkey PRIMARY KEY (id);
ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
ALTER TABLE ONLY public.answers
    ADD CONSTRAINT answers_question_id_foreign FOREIGN KEY (question_id) REFERENCES public.questions(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.forum_posts
    ADD CONSTRAINT forum_posts_forum_id_foreign FOREIGN KEY (forum_id) REFERENCES public.kelas_forums(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.forum_posts
    ADD CONSTRAINT forum_posts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_created_by_foreign FOREIGN KEY (created_by) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.kelas_forums
    ADD CONSTRAINT kelas_forums_class_id_foreign FOREIGN KEY (class_id) REFERENCES public.kelas(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.kelas_forums
    ADD CONSTRAINT kelas_forums_created_by_foreign FOREIGN KEY (created_by) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.kelas_members
    ADD CONSTRAINT kelas_members_class_id_foreign FOREIGN KEY (class_id) REFERENCES public.kelas(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.kelas_members
    ADD CONSTRAINT kelas_members_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.questions
    ADD CONSTRAINT questions_quiz_id_foreign FOREIGN KEY (quiz_id) REFERENCES public.quizzes(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.quiz_attempts
    ADD CONSTRAINT quiz_attempts_quiz_id_foreign FOREIGN KEY (quiz_id) REFERENCES public.quizzes(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.quiz_attempts
    ADD CONSTRAINT quiz_attempts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.quizzes
    ADD CONSTRAINT quizzes_class_id_foreign FOREIGN KEY (class_id) REFERENCES public.kelas(id) ON DELETE SET NULL;
ALTER TABLE ONLY public.quizzes
    ADD CONSTRAINT quizzes_created_by_foreign FOREIGN KEY (created_by) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.study_materials
    ADD CONSTRAINT study_materials_class_id_foreign FOREIGN KEY (class_id) REFERENCES public.kelas(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.study_materials
    ADD CONSTRAINT study_materials_uploaded_by_foreign FOREIGN KEY (uploaded_by) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.thread_discussions
    ADD CONSTRAINT thread_discussions_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.thread_replies
    ADD CONSTRAINT thread_replies_thread_id_foreign FOREIGN KEY (thread_id) REFERENCES public.thread_discussions(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.thread_replies
    ADD CONSTRAINT thread_replies_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;