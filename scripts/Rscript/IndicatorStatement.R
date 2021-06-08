library(tidyverse)
library(RMariaDB)
library(dotenv)
library(readxl)

args <- commandArgs(TRUE)

excelFile <- args[1]
excelData <- read_excel(excelFile)

#indicator_value_ids <- strsplit(args[2], ',')
#indicator_value_ids <- indicator_value_ids[!is.na(indicator_value_ids)]
#indicator_value_ids <- as.integer(indicator_value_ids[[1]])
# dotenv::load_dot_env("../../.env")

#con <- dbConnect(RMariaDB::MariaDB(),
#                 dbname = Sys.getenv("DB_DATABASE"),
#                 host = Sys.getenv("DB_HOST"),
#                 port = as.integer(Sys.getenv("DB_PORT")),
#                 user = Sys.getenv("DB_USERNAME"),
#                 password = Sys.getenv("DB_PASSWORD")
#)

#report_view <- tbl(con, "pdf_report_view")

#if (length(indicator_value_ids) > 0) {
#   report_view <- report_view %>%
#    filter(ID %in% indicator_value_ids)
#}

#data <- report_view%>%
#  collect()
