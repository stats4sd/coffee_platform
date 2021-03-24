library(tidyverse)
library(RMySQL)
library(dotenv)

args <- commandArgs(TRUE)

dotenv::load_dot_env("../../.env")

con <- dbConnect(RMySQL::MySQL(),
                 dbname = Sys.getenv("DB_DATABASE"),
                 host = Sys.getenv("DB_HOST"),
                 port = as.integer(Sys.getenv("DB_PORT")),
                 user = Sys.getenv("DB_USERNAME"),
                 password = Sys.getenv("DB_PASSWORD")
)

report_view <- tbl(con, "pdf_report_view")

data <- report_view%>%
  collect()
