## Load environment + setup paths to RMarkdown dependancies
# Required to ensure R called from CLI has the needed PATH entries to generate the pdf with PDF LATEX
dotenv::load_dot_env("../../.env")
Sys.setenv(PATH=paste0(
        Sys.getenv('PDFLATEX_PATH'),
        ':',
        Sys.getenv('PATH')
    )
)

rmarkdown::render('PDF_Report_Script_es.Rmd')
