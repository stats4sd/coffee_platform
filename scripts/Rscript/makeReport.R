dotenv::load_dot_env("../../.env")
Sys.setenv(PATH=paste0(
        Sys.getenv('PDFLATEX_PATH'),
        ':',
        Sys.getenv('PATH')
    )
)

rmarkdown::render('PDF Report Script.Rmd')