library(tidyverse)
library(openxlsx)
library(kableExtra)
library(knitr)
library(scales)

report_characteristics <- function(data, x){
  report_characteristics <- data.frame(
    Detail = c(
      rep("Country", length(unique(data1$country))),
      rep("Years", length(unique(data1$year))),
      rep("Source Type", length(unique(data1$source_partner_type))),
      rep("Purpose", length(unique(data1$purpose))),
      rep("Gender", length(unique(data1$gender))),
      rep("Scope", length(unique(data1$scope)))),
    Value = c(
      unique(data1$country),
      unique(data1$year),
      unique(data1$source_partner_type),
      unique(data1$purpose),
      unique(data1$gender),
      unique(data1$scope)
    )
  )
  
  report_characteristics <- flextable(report_characteristics)%>%
    set_header_labels(Detail = "Report Characteristics",
                      Value = "Report Characteristics")%>%
    merge_v(j = 1)%>%
    merge_h(part = "header")%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    theme_box()%>%
    autofit()
  
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

indicator_details(data1, indicator_codes[1])

value_table <- function(data, x, y){
  value_table <- data%>%
    filter(code == x & country == y)%>%
    select(country,purpose, gender, scope, source_name, value_standard, year, group)%>%
    arrange(year)%>%
    mutate(Purpose = paste0(purpose, "\n",
                            "Gender: ", gender, "\n",
                            "Scope: ", scope))%>%
    mutate(source_name = ifelse(!is.na(group), paste0(source_name, " Group:", group), source_name))%>%
    select(-purpose, -scope, -gender, -group)%>%
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
    width(j = 1, width = 3)
  
  return(value_table)
  
}


bar_graph <- function(data, x){
  
  data <- data%>%
    filter(code == x)  
  
  p1 <- data%>%
    ggplot(aes(fill = country, y=value_standard, x = year))+
    geom_col(position = position_dodge2(preserve = "single"))+
    labs(fill = "Country",
         x = "Year",
         y = paste0(data$name, " (", data$unit_standard[1], ")"),
         title = paste(data$code, " ", data$name))+
    scale_fill_brewer(palette = "Dark2")+
    theme_light()
  
  if(data$value_standard[1] == "%"){
    
    p1 <- scale_y_continuous(labels = percent)
    
  }else{}
  
  return(p1)
  
}

definition_table <- function(data, x){
  t <-data%>%
    filter(code == x)%>%
    select(source_name, source_partner, indicator_name_original, indicator_definition)%>%
    group_by(source_name)%>%
    slice(1)
  
  definition_table <- flextable(t)%>%
    set_header_labels(source_name = "Source",
                      source_partner = "Source Partner",
                      indicator_name_original = "Original Indicator Name",
                      indicator_definition = "Indicator Definition")%>%
    bg(i = 1, bg = "#A8D08D", part = "header")%>%
    theme_box()%>%
    width(j = 1:4, width = c(2,1,1,2))
  
  return(definition_table)
  
}  