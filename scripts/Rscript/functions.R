library(tidyverse)
library(openxlsx)
library(kableExtra)
library(knitr)
library(scales)

FitFlextableToPage <- function(ft, pgwidth = 6){
  
  ft_out <- ft %>% autofit()
  
  ft_out <- width(ft_out, width = dim(ft_out)$widths*pgwidth /(flextable_dim(ft_out)$widths))
  return(ft_out)
}

report_characteristics <- function(data, x){
  
  report_characteristics <- data.frame(
    col1 = c("Country", "Years", "Source Type", "Purpose", "Gender", "Scope"),
    col2 = c(
      gsub('"', '',paste(shQuote(unique(data$country)), collapse=", ")),
      gsub('"', '',paste(shQuote(unique(data$year)), collapse=", ")),
      gsub('"', '',paste(shQuote(unique(data$source_partner_type)), collapse=", ")),
      gsub('"', '',paste(shQuote(unique(data$purpose)), collapse=", ")),
      gsub('"', '',paste(shQuote(unique(data$gender)), collapse=", ")),
      gsub('"', '',paste(shQuote(unique(data$scope)), collapse=", "))
    )
  )
  
  report_characteristics <- flextable(report_characteristics)%>%
    set_header_labels(col1 = "Report Characteristics",
                      col2 = "Report Characteristics")%>%
    merge_v(j = 1)%>%
    merge_h(part = "header")%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    theme_box()%>%
    fix_border_issues()%>%
    width(j = 2, width = 5)
  
  report_characteristics <- FitFlextableToPage(report_characteristics)
  
  return(report_characteristics)
}

indicator_details <- function(data, x){
  data <- data%>%filter(code == x)
  
  value_table <- data.frame(
    "col1" = c("Indicator", "Indicator Code", "Indicator unit"),
    "col2" = c(data$name[1], x, data$unit_standard[1])
  )
  
  value_table <- flextable(value_table)%>%
    set_header_labels(col1 = "", col2 = "")%>%
    delete_part("header")%>%
    border_remove()%>%
    autofit()
  
  return(value_table)
  
}

value_table <- function(data, x, y){
  
  sample_minimum <- min(data$sample_size[data$code==x & data$country == y], na.rm = TRUE)
  
  year_n <- length(unique(data$year[data$code==x & data$country == y]))
  
  value_table <- data%>%
    filter(code == x & country == y)%>%
    select(country,purpose, gender, scope, source_name, value_standard, year, group, sample_size)%>%
    arrange(year)%>%
    mutate(Purpose = paste0(purpose, "\n",
                            "Gender: ", gender, "\n",
                            "Scope: ", scope))%>%
    mutate(source_name = ifelse(!is.na(group), paste0(source_name, " Group:", group), source_name))%>%
    select(-purpose, -scope, -gender, -group)
    
  if(sample_minimum<=20){
    
    value_table <- value_table%>%
      mutate(value_standard = ifelse(sample_size <=20, paste0(value_standard, "*"), value_standard))%>%
      select(-sample_size)%>%
      pivot_wider(names_from = year, values_from = value_standard)%>%
      mutate_all(as.character)%>%
      rename("Source" = "source_name")%>%
      replace(is.na(.), "-")%>%
      select(-country)%>%
      mutate(Purpose = as.factor(Purpose))%>%
      arrange(Purpose)%>%
      as_grouped_data("Purpose")%>%
      as_flextable()%>%
      add_header_lines(values = y)%>%
      bold(i = ~!is.na(Purpose))%>%
      bg(i = 1, bg = "#A8D08D", part = "header")%>%
      bg(i = 2, bg = "#EDEDED", part = "header")%>%
      bg(i = ~!is.na(Purpose), bg = "#E2EFD9")%>%
      theme_box()%>%
      add_footer_lines(values = "* - Sample size for reported value is 20 or less")%>%
      fix_border_issues()%>%
      align(j = 2:(year_n+1), align = "center")%>%
      align(i = 2, j = 2:(year_n+1), align = "center", part = "header")
    
    if(year_n>5){
    value_table <- rotate(value_table, i=2, j=-1, rotation = "tbrl", part = "header")
    }
    
    value_table <- width(value_table,j=1:(year_n+1), width = c(3, rep(3.5/year_n, year_n)))
    
    return(value_table)
    
    
  }  
  value_table <- value_table%>%
    select(-sample_size)%>%
    pivot_wider(names_from = year, values_from = value_standard)%>%
    mutate_all(as.character)%>%
    rename("Source" = "source_name")%>%
    replace(is.na(.), "-")%>%
    select(-country)%>%
    mutate(Purpose = as.factor(Purpose))%>%
    arrange(Purpose)%>%
    as_grouped_data("Purpose")%>%
    as_flextable()%>%
    add_header_lines(values = y)%>%
    bold(i = ~!is.na(Purpose))%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    bg(i = 2, bg = "#EDEDED", part = "header")%>%
    bg(i = ~!is.na(Purpose), bg = "#E2EFD9")%>%
    theme_box()%>%
    fix_border_issues()%>%
    align(j = 2:(year_n+1), align = "center")%>%
    align(i = 2, j = 2:(year_n+1), align = "center", part = "header")
  
  if(year_n>5){
    value_table <- rotate(value_table, i=2, j=-1, rotation = "tbrl", part = "header")
  }

  value_table <- width(value_table,j=1:(year_n+1), width = c(3, rep(3.5/year_n, year_n)))
  return(value_table)
  
}


bar_graph <- function(data, x){
  
  data <- data%>%
    filter(code == x)%>%
    arrange(year)%>%
    mutate(year = as.character(year))
  
  if(data$unit_standard[1] == "%"){
    p1 <- data%>%
      ggplot(aes(fill = country, y=value_standard/100, x = year))+
      geom_col(position = position_dodge2(preserve = "single"))+
      labs(fill = "Country",
           x = "Year",
           y = paste0(data$name, " (", data$unit_standard[1], ")"),
           title = paste(data$code, " ", data$name))+
      scale_fill_brewer(palette = "Dark2")+
      theme_light()+
      scale_y_continuous(limits = c(0,1),
                         labels = percent)
    
    return(p1)
    
  }
  
  p1 <- data%>%
    ggplot(aes(fill = country, y=value_standard, x = year))+
    geom_col(position = position_dodge2(preserve = "single"))+
    labs(fill = "Country",
         x = "Year",
         y = paste0(data$name, " (", data$unit_standard[1], ")"),
         title = paste(data$code, " ", data$name))+
    scale_fill_brewer(palette = "Dark2")+
    theme_light()
  
  return(p1)
  
}

definition_table <- function(data, x){
  t <-data%>%
    filter(code == x)%>%
    select(source_name, source_partner, indicator_name_original, definition_original)%>%
    group_by(source_name)%>%
    slice(1)
  
  definition_table <- flextable(t)%>%
    set_header_labels(source_name = "Source",
                      source_partner = "Source Partner",
                      indicator_name_original = "Original Indicator Name",
                      definition_original = "Indicator Definition")%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    theme_box()%>%
    fix_border_issues()%>%
    width(j = 1:4, width = c(2,1,1,2))
  
  return(definition_table)
}  
