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

data_cc <- report_view%>%
  collect()

x <- sample(1:length(unique(data_cc$`Indicator code`)), 1)

indicators_filter <- sample(unique(data_cc$`Indicator code`), x, replace = FALSE)

data <-  filter(data_cc, `Indicator code` %in% indicators_filter)
