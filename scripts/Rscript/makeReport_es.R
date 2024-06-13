library(stringr)

## Load environment + setup paths to RMarkdown dependencies
# Required to ensure R called from CLI has the needed PATH entries to generate the pdf with PDF LATEX
dotenv::load_dot_env("../../.env")
Sys.setenv(PATH=paste0(
        Sys.getenv('PDFLATEX_PATH'),
        ':',
        Sys.getenv('RSTUDIO_PANDOC') %>% str_replace('pandoc', ''),
        ':',
        Sys.getenv('PATH')
    )
)

rmarkdown::render('PDF_Report_Script_es.Rmd')
