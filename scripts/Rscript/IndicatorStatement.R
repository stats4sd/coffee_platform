library(openxlsx)

args <- commandArgs(TRUE)

excelFile <- args[1]
excelData <- openxlsx::read.xlsx(excelFile, sheet=2)
